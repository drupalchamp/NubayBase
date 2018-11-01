#!/bin/bash

php -r '$sites=array();$f="/var/www/html/sites/sites.php";$p="--uri=";file_exists($f)&&include($f);foreach($sites as $s=>$u){echo $p.$s,"\n";}' |
while read URI ; do
  sudo -i -u ec2-user drush vset maintenance_mode 0 --nocolor --root=/var/www/html $URI
done
