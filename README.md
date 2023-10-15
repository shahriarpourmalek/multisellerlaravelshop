
# Nahira Shop

The "Nahira Shop" website is a Laravel-based online store that features various categories. Some of the site's functionalities include category management, user management, blog management, product management, discount management, order management, transportation management, and more. These features make the site highly functional and unique. It has also been highly secured for safety, and its execution is very user-friendly.



  

## Installation

for  instalation on your cpanel host  there  is  some  requirements

+ PHP 8.1.12 (version 7.3 required)
+ OpenSsl extension
+ Pdo extension
+ Mbstring extension
+ Tokenizer extension
+ OpenSsl extension
+ JSON
+ CURL
+ Fileinfo
+ Zip

also we  need  access premision "745" to some  folders  in project  

+ storage/framework/
+ storage/logs/
+ bootstrap/cache/


and atlast  we  need  a  mysql database  for  seed and  migrate  database tables  in it  

then you click on install button in automaticly seed datas ,link storage and generate key for  project then you must register a  admin rememeber  username and  password  also admin panel url prefix  if you forgot admin panel url it  accessable in .env file in project

## Directory Structure

── app
│   ├── Channels   
│   ├── Console
│   │   ├── Commands
│   ├── Contracts
│   ├── Events
│   ├── Exceptions
│   ├── Exports
│   │   ├── Sheets
│   ├── Http
│   │   ├── Controllers
│   │   ├── Middleware
│   │   ├── Requests
│   │   ├── Resources
│   │   └── Traits
│   ├── Imports
│   ├── Interfaces
│   │   └── Repositories
│   ├── Jobs
│   ├── Listeners
│   ├── Models
│   ├── Notifications
│   │   ├── Contact
│   │   ├── Order
│   │   ├── Sms
│   │   ├── User
│   │   └── Wallet
│   ├── Observers
│   ├── Policies
│   ├── Providers
│   ├── Repositories
│   ├── Rules
│   ├── Services
│   │   └── Sms
│   └── Traits
├── bootstrap
│   ├── cache
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── packages
│   ├── codedge
│   └── shetabit
├── public
├── resources
│   ├── css
│   ├── js
│   ├── lang
│   └── views
├── routes
├── storage
├── stubs
├── tests
├── themes
│   └── DefaultTheme
├── vendor


 + app:

+ Channels: Communication channels like broadcasting.
+ Console: Artisan commands for managing the application.
+ Contracts: Interfaces defining the "contract" for classes.
+ Events: Event classes for application events.
+ Exceptions: Custom exception classes.
+ Exports: Classes for exporting data to various formats.
+ Http: Main directory for HTTP-related classes.
+ Imports: Classes for importing data from various formats.
+ Interfaces: Custom interfaces for the application.
+ Jobs: Queueable jobs for background processing.
+ Listeners: Event listeners for handling events.
+ Models: Eloquent model classes for database interaction.
+ Notifications: Notification classes for email and notifications.
+ Observers: Eloquent model observers.
+ Policies: Authorization policies.
+ Providers: Service providers for bootstrapping.
+ Repositories: Custom repositories for data access.
+ Rules: Custom validation rules.
+ Services: Business logic and services.
+ Traits: Reusable PHP traits for classes.
+ bootstrap:

+ cache: Cached files for faster application bootstrapping.
+ config:Configuration files for the application.
+ database:
    + factories: Factories for creating model instances in tests.
    + migrations: Database schema migration files.
    + seeders: Database seeders for initial data population.
+ packages:Subdirectories for external packages or dependencies.
+ public: Publicly accessible assets such as CSS, JavaScript, and images.
+ resources:
 + css: CSS styles for the application.
 + js: JavaScript files.
 + lang: Language files for localization.
 + views: Blade templates for views.
 + routes:Route definitions for web and API routes.
+ storage:Storage for generated files, logs, and caches.
+ stubs:Placeholder files for code generation.
+ tests:Test cases and test-related files.
+ themes: Custom themes or theme-related resources.
+ vendor:Dependencies installed via Composer.

## configuration

after  installation everything you need  to change  about nahira shop is in the  .env folder this  is a  example of  env file



APP_NAME='nahira-shop'
APP_ENV=local
APP_KEY=base64:0xVqReL4V6CP4TxQIf8GVMI0001u7Pcj0orxjhEvofM=
APP_DEBUG=false
DEBUGBAR_ENABLED=false
APP_URL=http://127.0.0.1:8000
LOG_LEVEL=debug
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelshop
DB_USERNAME=root
DB_PASSWORD=password
CURRENT_THEME=DefaultTheme
BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=database
QUEUE_CONNECTION=database
SESSION_LIFETIME=120
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
CURRENT_THEME=DefaultTheme
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
ADMIN_ROUTE_PREFIX=admin94127

## installation on localhost
Execute these commands below, in order
1. clone the project

1. composer install

2. cp .env.example .env

4. php artisan migrate --seed

4. php artisan shop:link

after that you must run the command to work queue

5. php artisan queue:listen

Register for first time:

http(s)://example.com/login

steps to update
pull latest changes using git and run these commands

1. git pull origin master

2. composer i

2. php artisan optimize:clear

4. php artisan updater:after