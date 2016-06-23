#!/usr/bin/env bash
ip=192.168.1.72
cd /var/www
sshpass -p raspberry scp -r scheduler/* pi@${ip}:/var/www/html/
sshpass -p raspberry scp -r lightboard-controller/* pi@${ip}:/var/www/html/lightboards
