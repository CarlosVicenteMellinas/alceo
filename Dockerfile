FROM carlosvicente01/apache-php:latest
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get updat
RUN rm -fr /var/www/html/* && git clone https://github.com/CarlosVicenteMellinas/alceo.git /var/www/html
EXPOSE 80
CMD ["/bin/bash"]
