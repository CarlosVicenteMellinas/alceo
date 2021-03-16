FROM carlosvicente01/apache-php:latest
RUN apt-get update && \
    apt-get install -y git
RUN rm -fr /var/www/html/* && git clone https://github.com/CarlosVicenteMellinas/alceo.git /var/www/html
EXPOSE 80
CMD ["/bin/bash"]
