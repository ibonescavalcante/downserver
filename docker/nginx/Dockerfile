FROM nginx:1.23

COPY conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY snippets/ /etc/nginx/snippets/

COPY . /var/www
