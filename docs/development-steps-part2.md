1-  Add Extra feature in Exceptions\Handler.php
    A) Add Traits
        use JsonResponseTrait;
        use JsonExceptionHandlerTrait;
    
    B) Overwrite render method
        public function render($request, Throwable $e): Response
        {
            //Render an exception into a json response
            if ($this->isJsonApi($request)) {
                return $this->renderJsonApi($request, $e);
            }
    
            //Render an exception into web response
            return parent::render($request, $e);
        }

    C) Run App and check it from POSTMAN
        $ composer update
        $ php artisan serve
        

        ---------------------------------------------------
        2-
            A) Define api routes
            B) Shift Controllers to App\Http\Controllers\Api\Backend\V1
        
        ---------------------------------------------------
        3- customize hashids encode/decode and publish it in config folder


---------------------------------------------------
4-Add default parameter group middleware [DefaultParametersAllocating] to kernel

    //Set Default Parameters Allocating
    protected $middlewareGroups = [
        'web' => [
            ...
            DefaultParametersAllocating::class
        ],

        'api' => [
            ...
            DefaultParametersAllocating::class
        ],
    ];

---------------------------------------------------
5- Setup oAuth2 to have a logged user



---------------------------------------------------
6- Creating Policies
    A) php artisan make:policy AuthorPolicy --model=Author
    
    B) add policy in AuthServiceProvider.php

    protected $policies = [
         'App\Models\Author' => 'App\Policies\AuthorPolicy',
    ];


---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------




10- Do second commit
git add .
git commit -m "WIP-001-Basic CRUDs Requirements, migrations, factories, ..."

---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------
---------------------------------------------------



    php artisan serve

