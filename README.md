# free-realtime-crud-laravel-vue
realtime crud in laravel &amp; vue using redis,laravel-echo ,socket.io,data-table 

#Note:install redis to run the application
-make the configuration for laravel-echo and redis
,change .env variable  MAIL_TO_ADDRESS_ON_ADDED_PRODUCTS in .env.example to receive mails when adding new products
,run cp .env.example .env
#languages,libraries,technologies  used:
 Laravel,vue,vue-router,Redis,axios,laravel-echo,socket.io
Notes:

#steps to run app
commands should be run in terminal in every tab:

php artisan serve
npm install 
npm run dev
laravel-echo-server start
php artisan queue:work
