
-------------------------
SYSTEM FEATURES:
-------------------------
1- Modify .env file according to the database settings
        DB_HOST=localhost   #127.0.0.1
        DB_PORT=3306
        DB_DATABASE=publisher_db
        DB_USERNAME=root
        DB_PASSWORD=root
        DB_PREFIX=tbl_
        DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock


2- migrations && seeds and factories files work perfectly, but I suggest you import your database instead.
    database/sql/publisher_db.sql__2021-08-20__18.34.zip
    
    or run related commands instead
        $ php artisan migrate     
        $ php artisan db:seed

3- Import POSTMAN collection, so you can easily see all the tested apis:
    docs/Encubate-Publisher.postman_collection.json

