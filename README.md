
#### Setting up Ubuntu in Windows

1. Install **Ubuntu 22 LTS** from the windows store
2. then open ubuntu

## Setup Locally 

3. go to source code
4. run **composer install**
5. run **./vendor/bin/sail up -d**
6. run **cp .env.example .env**
7. run **docker exec -it ip-address-management-laravel.test-1 bash**
8. run **php artisan migrate**
9. run **php artisan db:seed**
10. run **php artisan passport:install**


Would you like to run all pending database migrations? (yes/no) [yes]:
> yes

Would you like to create the "personal access" and "password grant" clients? (yes/no) [yes]:
> yes

11. Copy the Client ID and Client Secret of **Password grant** 

Sample:
>INFO  Password grant client created successfully.
> 
>Client ID .... 2
> 
>Client secret .... BlB0b6pF3uDA8JG3nFdxAmmMNzk0dKB37uiGNp4E


11. update ENV to have CLIENT_ID and CLIENT_SECRET values based on the generated values in **oauth_clients** table or the info given in the step 11.
12. run **php artisan config:clear**
13. run **npm install**
14. run **npm run dev**
