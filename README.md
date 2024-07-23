<h1 align="center">Laravel Project Setup Guide</h1>
<p align="center">A comprehensive guide to set up your Laravel project on your local machine.</p>
<h1>Prerequisites</h1>
<p>Before you begin, ensure you have the following installed:</p>
<ul>
    <li>PHP (version >= 7.4)</li>
    <li>Composer</li>
    <li>Node.js and NPM</li>
    <li>MySQL or any compatible database server</li>
</ul>
<h1 align="center">Follow the steps:</h1>
<ol>
    <li>Create database and write your database name into .env file</li>
    <li>composer install</li>
    <li>composer update</li>
    <li>npm install chart.js</li>
    <li>php artisan migrate</li>
    <li>php artisan storage:link</li>
    <li>php artisan db:seed --class=RoleSeeder</li>
    <li>php artisan db:seed --class=UserSeeder</li>
</ol>
<h4 align="center">Getting news api routes:</h4>
<ul>
    <li>your-project/api/v1/news</li>
    <li>your-project/api/v1/news/{id}</li>
</ul>
