## Setup Locally

1. go to root folder and run **./vendor/bin/sail up -d**
2. run **php artisan migrate**
3. run **php artisan passport:install**
4. run cp .env.example .env
5. update ENV to have CLIENT_ID and CLIENT_SECRET values based on the generated values in **oauth_clients** table
6. run npm run dev

#### For Windows
1. run **composer install**
2. Install **Ubuntu 22 LTS** from the windows store
3. then open ubuntu and go to the source code
4. go to root folder and run **./vendor/bin/sail up -d**
5. run **php artisan migrate**
6. run **php artisan passport:install**
7. run cp .env.example .env
8. update ENV to have CLIENT_ID and CLIENT_SECRET values based on the generated values in **oauth_clients** table
9. run npm run dev
