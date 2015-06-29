cp /var/www/main/imgur.db ~/imgur.db.bak                                                                                       
grep -v $1 /var/www/main/imgur.db > /var/www/main/imgur-2.db; mv /var/www/main/imgur-2.db /var/www/main/imgur.db               
chown www-data:www-data /var/www/main/imgur.db  
