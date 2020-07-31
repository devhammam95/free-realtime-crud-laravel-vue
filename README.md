# free-realtime-crud-laravel-vue
Realtime crud using laravel ,vue,vue-router,Redis,axios,laravel-echo,socket.io
    
 ## Usage
 
<ul>
<li>Make the configuration for laravel-echo and redis</li>
<li>Change .env variable  MAIL_TO_ADDRESS_ON_ADDED_PRODUCTS in .env.example to receive mails when adding new products</li>
</ul>


```bash
run in terminal  cp .env.example .env
```

## Installation

```
composer install
php artisan migrate --seed
php artisan serve
npm install
npm run dev
laravel-echo-server start
php artisan queue:work
```

