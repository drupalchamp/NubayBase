#!/bin/bash

php -r '$sites=array();$f="/var/www/html/sites/sites.php";$p="--uri=";file_exists($f)&&include($f);foreach($sites as $s=>$u){echo $p.$s,"\n";}' |
while read URI ; do
  sudo -i -u ec2-user drush vset maintenance_mode 1 --nocolor --root=/var/www/html $URI
  sudo -i -u ec2-user drush cc all --nocolor --root=/var/www/html $URI
done

instance=`curl -s http://169.254.169.254/latest/meta-data/instance-id`
region=`curl -s http://169.254.169.254/latest/dynamic/instance-identity/document/ | awk -F'"' '/region/ {print $4}'`
name=`aws ec2 describe-tags --filters "Name=resource-id,Values=$instance" "Name=key,Values=Name" --region $region --query "Tags[0].Value" --output text`
today=`date +%Y-%m-%d.%H:%M:%S`
aws ec2 describe-instance-attribute --instance-id $instance --attribute blockDeviceMapping --query "BlockDeviceMappings[].[DeviceName,Ebs.VolumeId]" --region $region --output text >/tmp/drupal_update_snapshot.txt
sync
status=0
for target in $(findmnt -nlo TARGET -t ext4); do fsfreeze -f $target; done
while read device volume ; do
  createsnapshotid=$(aws ec2 create-snapshot --volume-id $volume --description "{$name} {$volume} {$instance} {$today}" --region $region | awk -F'"' '/SnapshotId/ {print $4}')
  [ ${PIPESTATUS[0]} -eq 0 ] || status=1
  aws ec2 create-tags --resources $createsnapshotid --region $region --tags "Key=Name,Value=$name" || status=1
  echo SNAPSHOT $createsnapshotid $device ${instance}-$today
done </tmp/drupal_update_snapshot.txt
for target in $(findmnt -nlo TARGET -t ext4); do fsfreeze -u $target; done
checksnap=`aws ec2 describe-snapshots --filters "Name=snapshot-id,Values=$createsnapshotid" --region $region --query "Snapshots[0].SnapshotId" --output text`
if [ "$createsnapshotid" != "$checksnap" ] ; then
  echo 'failed to verify snapshot' ; exit 1
fi
