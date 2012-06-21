#!/bin/bash
rm -rf app/cache/*
rm -rf app/logs/*
sudo setfacl -R -m u:www-data:rwx -m u:uros:rwx app/cache app/logs
sudo setfacl -dR -m u:www-data:rwx -m u:uros:rwx app/cache app/logs
