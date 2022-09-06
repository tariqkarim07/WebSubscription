How to run 
- git clone https://github.com/tariqkarim07/WebsiteSubscription.git

go to folder path
- run composer install
- copy .env.example to .env and change values for database, mail server etc
- run migration php artisan migrate

for predefined websites data 
- run seeder php artisan db:seed or seeder php artisan db:seed --class=WebsiteDataSeeder

-  run "php -S localhost:8000 -t public" / alternate you can create virtual host 

for apis please check postman documentaions
public link for apis
https://www.getpostman.com/collections/c0cadea1f99f36f6cdc3
