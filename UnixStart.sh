#!/bin/bash
docker build -t web/mail .
docker run -ti -v /home/messagerie:/usr/share/nginx/databases -d -p 8080:80 --name messagerie --hostname messagerie web/mail

docker exec -u root messagerie service nginx start
docker exec -u root messagerie service php5-fpm start
