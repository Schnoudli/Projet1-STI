#Permet de lancer le contener docker avec la base de donnée situé dans Messagerie, et accessible via le port 8080
docker run -ti -v "C:/Messagerie/":/usr/share/nginx/databases -d -p 8080:80 --name messagerie --hostname messagerie andrejacquemond/messagerie

#Permet de lancer nginx et php5
docker exec -u root messagerie service nginx start
docker exec -u root messagerie service php5-fpm start