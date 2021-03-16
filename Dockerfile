FROM carlosvicente01/apache-php:latest
RUN rm -fr /var/www/html/* && git clone https://github.com/CarlosVicenteMellinas/alceo.git /var/www/html
EXPOSE 80
