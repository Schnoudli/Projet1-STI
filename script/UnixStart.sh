#!/bin/bash
docker run -ti -v /Users/Messagerie:/usr/share/nginx/databases -d -p 8080:80 --name messagerie --hostname messagerie andrejacquemond/messagerie

docker exec -u root messagerie service nginx start
docker exec -u root messagerie service php5-fpm start
