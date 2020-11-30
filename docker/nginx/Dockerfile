# Pull the nginx:1.17 image
FROM nginx:1.17

# Configure nginx
ADD mingle.conf /etc/nginx/conf.d/default.conf

# Defining WORKDIR of container
WORKDIR /var/www/mingle

# Expose on default port
EXPOSE 80
