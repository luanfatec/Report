#!/bin/bash 

cd /volume/
php index.php update-db &>> log


echo -ne "\n[$(date)] Command executed" >> log
echo -ne "\n[$(date)] Query performed successfully\n" >> log
