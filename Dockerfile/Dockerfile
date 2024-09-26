# Imagem base do Ubuntu
FROM ubuntu:latest

# Atualize e instale pacotes necessários
RUN apt-get update && \
    apt-get install -y \
    mysql-server \
    php-cli \
    php-mysql \
    php-xml \
    php-mbstring \
    && apt-get clean

# Defina variáveis de ambiente para o MySQL
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=loja404
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=senha

# Copie os arquivos do projeto PHP para o contêiner
COPY . /var/www/html

# Exponha as portas necessárias
EXPOSE 3306 8080

# Inicialize o MySQL e o servidor embutido PHP
CMD service mysql start && \
    sleep 5 && \
    mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS ${MYSQL_DATABASE};" && \
    mysql -uroot -proot ${MYSQL_DATABASE} < /var/www/html/script.sql && \
    mysql -uroot -proot -e "CREATE USER 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}';" && \
    mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;" && \
    mysql -uroot -proot -e "FLUSH PRIVILEGES;" && \
    sed -i 's/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf && \
    service mysql restart && \
    php -S 0.0.0.0:8000 -t /var/www/html