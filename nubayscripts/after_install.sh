#!/bin/bash

/usr/sbin/SetDrupalFilePerm.sh

php -r '$sites=array();$f="/var/www/html/sites/sites.php";$p="--uri=";file_exists($f)&&include($f);foreach($sites as $s=>$u){echo $p.$s,"\n";}' |
while read URI ; do
  sudo -i -u ec2-user drush updb --nocolor --root=/var/www/html $URI || exit 1
  sudo -i -u ec2-user drush cvupdb --nocolor --root=/var/www/html $URI || exit 1
  chmod g+w /var/www/html/sites/*/files/civicrm/ConfigAndLog/*
  dversion=`sudo -i -u ec2-user drush status --nocolor --root=/var/www/html $URI --format=list 'Drupal version'` || exit 1
  sudo -i -u ec2-user drush sql-query --nocolor --root=/var/www/html $URI "update backup_migrate_profiles set filename='[site:name]_D${dversion}_DrupalDB_[current-date:custom:Y-m-d\\\\TH-i-s]', append_timestamp = 2 where machine_name like 'drupal%'" || exit 1
  cversion=`sudo -i -u ec2-user drush civicrm-sql-query --nocolor --root=/var/www/html $URI 'select max(version) from civicrm_domain'` || exit 1
  sudo -i -u ec2-user drush sql-query --nocolor --root=/var/www/html $URI "update backup_migrate_profiles set filename='[site:name]_C${cversion}_CivDB_[current-date:custom:Y-m-d\\\\TH-i-s]', append_timestamp = 2 where machine_name like 'civicrm%'" || exit 1
done
