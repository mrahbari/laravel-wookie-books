        1- Installation Via Composer
            $ composer global require laravel/installer
            $ laravel new authors-books-app
            copy all cloned files[.git , readme] into authors-books-app folder
            $ cd authors-books-app
        
        ---------------------------------------------------
        2- 
            A) Setup DB connections in .env
                DB_CONNECTION=mysql
                DB_HOST=localhost   #127.0.0.1
                DB_PORT=3306
                DB_DATABASE=publisher_db
                DB_USERNAME=root
                DB_PASSWORD=root
                DB_PREFIX=tbl_
                DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
        
        
            B) Add Prefix Constant to config/database.php mysql array
                            'prefix' => env('DB_PREFIX', ''),
        
            C)  create DB in mysql DB with collation = 'utf8mb4_unicode_ci';
        
        ---------------------------------------------------
        3- A little changes in app/Providers/AppServiceProvider.php
            public function boot()
            {
                Schema::defaultStringLength(191);
            }
        
        
        ---------------------------------------------------
        4- Add required plugins into composer
            composer require laravel/passport
            composer require vinkla/hashids
            composer require cviebrock/eloquent-sluggable
        
        
        ---------------------------------------------------
        5- Reconfigure composer.json to make new valid namespaces for modules and packages
        "autoload": {
            "psr-4": {
                ...
                ...
                "Base\\": "packages/base/src/",
                "Publisher\\": "modules/publisher/src/",
        
        ---------------------------------------------------
        6- 
            A) Make two folders : Prepare the system for the future to transfer to the microservice
                packages/base/src/
                modules/publisher/src/
        
            B) Copy custom base package in root of project
            
            C) Copy base.php in config folder
        
            D) Add Base\Providers\ModuleProvider::class in config/app.php, providers section!
        
            E)
                **** $ composer update to ensure app is healthy
                **** $ php artisan serve
                *** first commit with Installation & Basic requirements
        
        ---------------------------------------------------
        7- Fo first commit
            $ git add .
            $ git commit -m "WIP-000-Installation & Basic requirements"
            $ git checkout -b development
            ----- $ git push origin development

            ---------------------------------------------------
            8- 
                A) Add new column to user migration file [Permitted to publish]
                    $ php artisan make:migration add_some_fields_to_users_table --table=users
                
                B) Update UserSeeder.php for sample requested & modify DatabaseSeeder.php
---------------------------------------------------
9- 
    A) Generating Model Classes
        $ php artisan make:model Author --all
        $ php artisan make:model Book --all

    B) User Model should be extends BaseAuthenticatableModel
    C) Other Modeles should be extends BaseModel
    D) New Controllers Must be extends from BaseApiController

---------------------------------------------------
10- 
    A) Define model's fields in related migrate files
    B) Define Factories & modify DatabaseSeeder.php
    C) Define Seeds & modify DatabaseSeeder.php
    D) Run related commands  
        $ php artisan migrate     
        $ php artisan db:seed

---------------------------------------------------
---------------------------------------------------
11- Do second commit
    $ git add .
    $ git commit -m "WIP-001-Basic CRUDs Requirements, migrations, factories, ..."

---------------------------------------------------
