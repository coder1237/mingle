# Pull the mysql:8.0.19 image
FROM mysql:8.0.19

# Database environment
ENV MYSQL_DATABASE=mingle
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=root
ENV MYSQL_ROOT_HOST=0.0.0.0
ENV MYSQL_INITDB_XLOGDIR="/var/log/mysql"

# Mount the volume dbdata from host in container
VOLUME dbdata:/var/lib/mysql

# Expose on default port
EXPOSE 3306
