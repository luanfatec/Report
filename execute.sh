#!/bin/bash 

cd /volume/
php index.php update-db


echo -ne "\n[$(date)] Command executed" >> log
echo -ne "\n[$(date)] Query performed successfully" >> log
