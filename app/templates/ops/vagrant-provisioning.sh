#!/usr/bin/env bash

export PATH=/usr/local/bin:$PATH

# For mysql/postfix promptless install
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo debconf-set-selections <<< "postfix postfix/mailname string <%= ProjectFolder %>.dev"
sudo debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"

# Install packages
sudo apt-get update 2>&1 /dev/null
sudo apt-get -y install nginx mysql-server mysql-client php5-fpm php5-mysql php5-mcrypt php5-cli php5-curl git postfix unzip mysql-client 2> /dev/null

# Nginx conf
sudo mv /tmp/vagrant-nginx.conf /etc/nginx/sites-available/default
sudo mv /tmp/99-vagrant-php.ini /etc/php5/fpm/conf.d/99-vagrant-php.ini

# WP-CLI
cd /usr/local/bin
sudo curl -s -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
sudo mv wp-cli.phar wp
sudo chmod 755 wp

# cleanup and Preparation
cd $1
echo "Deleting old WP install if exists"
rm -rf {wp-admin,wp-includes,wp-*.php,xmlrpc.php,index.php,license.txt,readme.html}

# Prepare DB
mysql -u root -proot -e "create database if not exists <%= DatabaseName %>"
mysql -u root -proot -e "grant all privileges on <%= DatabaseName %>.* to <%= DatabaseUser %>@localhost identified by '<%= DatabaseUser %>'"
mysql -u root -proot -e "set password for '<%= DatabaseUser %>'@'localhost' = password('<%= DatabasePassword %>')"
mysql -u root -proot -e "flush privileges"

# Download WP
sudo -H -u www-data bash -c "wp core download"
sudo -H -u www-data bash -c "wp core config --dbname=<%= DatabaseName %> --dbuser=<%= DatabaseUser %> --dbpass=<%= DatabasePassword %> --dbhost=127.0.0.1 --skip-check"

# Install WordPress
echo "(Re)Installing wordpress"
sudo -H -u www-data bash -c "wp core install --url=http://192.168.33.33 --title='<%= ProjectName %>' --admin_user=admin --admin_password=admin --admin_email=someone@localhost.com"
sudo -H -u www-data bash -c "wp plugin deactivate hello"
sudo -H -u www-data bash -c "wp plugin uninstall hello"
sudo -H -u www-data bash -c "wp plugin update --all"
sudo -H -u www-data bash -c "wp plugin activate --all"
sudo -H -u www-data bash -c "wp theme activate <%= ThemeFolder %>"
# You should update the following to provide steps to restore from a recent production/staging pull
# sudo -H -u www-data bash -c "wp db import ./ops/database-dump-20150909.sql"
# sudo -H -u www-data bash -c "wp search-replace --url='52.24.214.246' '52.24.214.246' 192.168.33.33"
# sudo -H -u www-data bash -c "wp search-replace --url='www.domain4now.com' 'www.domain4now.com' 192.168.33.33"

# Cleanup
sudo service nginx restart

echo "=========== Done Provisioning ================"
echo "Visit http://192.168.33.33 to access your blog"