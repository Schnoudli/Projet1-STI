FROM arubinst/sti:project2018

RUN apt-get update

COPY html /usr/share/nginx/html

RUN chmod 755 -R /usr/share/nginx/html
RUN chmod 777 -R /usr/share/nginx/databases

COPY nginx.service /lib/systemd/system/