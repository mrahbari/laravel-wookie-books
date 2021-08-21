
composer require laravel/passport
php artisan migrate
php artisan passport:install


--------------------------------------------------
Add result to .env and keep it
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=1
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=YPbkvC39wT6C4J3tt6hjzXUDHSQxrxo4bdhbZ8bh
PASSPORT_PASSWORD_GRANT_USER_ID=2
PASSPORT_PASSWORD_GRANT_USER_SECRET=g4BwrEMQ0nflYqI2Fjnv3C7cV522XcPsOgJvHyWv

--------------------------------------------------
add the Laravel\Passport\HasApiTokens trait to your App\User model. 
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

--------------------------------------------------
you should call the Passport::routes method within the boot method of your AuthServiceProvider. 
class AuthServiceProvider extends ServiceProvider
{
   .... 
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }
}
--------------------------------------------------
in your config/auth.php configuration file, you should set the driver option of the api authentication guard to passport.
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
--------------------------------------------------
If you are not going to use Passport's default migrations, you should call the Passport::ignoreMigrations method in the register method of your AppServiceProvider.

Passport::ignoreMigrations();
php artisan vendor:publish --tag=passport-migrations

--------------------------------------------------
If you need Vue auth components:
php artisan vendor:publish --tag=passport-components

--------------------------------------------------
When deploying Passport to your production servers for the first time, you will likely need to run the passport:keys command. 
php artisan passport:keys
php artisan vendor:publish --tag=passport-config

--------------------------------------------------
Token Lifetimes

class AuthServiceProvider extends ServiceProvider
{
    ....
    ....
    public function boot()
    {
        $this->registerPolicies();
    
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
--------------------------------------------------
TEST VIA POSTMAN    --> POST    -->    {{host}}/oauth/token
    grant_type:password
    client_id:2
    client_secret:OoKTsvklImFmMbJohgbBqRKdkwHDorjT2rIGiYJO
    username:darth.vader@gmail.com
    password:password

        {
        "token_type": "Bearer",
        "expires_in": 31536000,
        "access_token": "eyJ0eXAihOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjYyYTkxNGIwMGUzNjNlYjc0NTc4NGVjMzA5YTAyZGJmNTEyMDdkNjBmMTkzM2FiZjU4YWQ0MTc5NTg2YWU1ZWUzMzg3ZTJlYmQyNjdlZWMiLCJpYXQiOjE2MjkzNTY1NTIuNTU0NTYsIm5iZiI6MTYyOTM1NjU1Mi41NTQ1NjMsImV4cCI6MTY2MDg5MjU1Mi41NDA0NTcsInN1YiI6IjEiLCJzY29wZXMiOlsiKiJdfQ.owZPNzorjQ2Cg197aHFX-NNCfAPg_m30TWOQSFIlGaDvFQAtb5r7ZEcaBHMbMtA6elIRMp2bKcJjHsKspyicGuv3OhWQEScV7DZcbPHdFMZzSXZOm4QFJqqfHz0dH5DXgMFXHM98Q9hqrIwYK6Yr0xv7Hl07htIgnOeH6fsuChtBOXbjpuxHO5xw4GaM_tMLLW2R8YZcZynB05hqNC2uVl-WGIkfFvLbZqa38qH03mDhPMUBfPpQ7lK5f8p8xnUbdhXj-8DwKLp4hoSGvnymoUgp_g5F6Y8epeNhVB_GSHOWlEH_ooldoVPdNoAYE5ZgtIQPkHwuCqJY4EABrpGEakI9iFyXICZNVHCQQECDO6BwdKzWWNmMU6NU4J-pm-X5T6-C6e7Fjwg0C1_Z-e_PLcf6725TJt2L-IrNCvhOVmrc-Bb0yAukhwsy0XqFpuZviXsB7b_-lOKSDOUXkfwHl-NtFE_Xmsrp3LOyGM6QH4T8DoEOiEDgoNQksI21MmC9Ic9eXWFBNoBjR6xCSuv6LiDddjiQFlkJMyM-gREynrcREC0QkDg-FYZglyac6ewKujdCXyqsJ9KmFjBtn6lS1LH-SiHsQQFA3hpqsQDzPYe0P54xjwVDGFxP1uOcrQY7CFZ7yJrR5Nq4aD4iVaoPZm_k1vcdcOtfSFVWC886jZM",
        "refresh_token": "def50200d4b90dac7e1f58c3e710be3d1d80188b2264e197dde660684564a4cda284fe1cdfe9759199ce65821fbc83713391e23ca0bca4b09ae7d3e8acc9aafbae64fdb1b833cd32712fa060449e7c9b9f74611df6a0c67aeb5a1b1b9a2c25ee5273d254c671cb51647ebcc0f5c327111bc7fb7d7dc09992c43066baef9af5794e18b0bacd048649178e55c91f5900725a2c928447c06d056271fef1db42f02511e0da295660594db7482629c7ceca2601adc2425a0e87054411d0450904d91566f355eac91b8fa704733562d310a62b22ea31dca51aa4f8235f5f5cecc6cfe20d5bf5e33a2066447e49ccc3bdc7fb68913afa80b3f568601718a7ef2828992582b6a8c79dc9010ff98e964bececbe89e9cf0f6ed89f214f17260cff0c778cb874a144aed837dbd661763700dba4e5c873a58d9b34363e578010ec10c97af92b808f17111c02c39c4597f652fb60b2e232fdb52b521a505a5162d78263defe9892dadf8c"
        }


grant_type:password
client_id:6
client_secret:Z2Vx3PH90LJ5ZoTi5dsbzwDEWybHXrQGjEYIOCmt
username:conor.tromp@example.com
password:password

    {
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiNDZlZDNjN2ViMTA3M2EyMGNiZmY5MTEwNTg0OGI5OTMxYjk3NWQ3MzA0MDE3NzU2NjBmZTJiYTllYzNkODJhZGJlNmVjYWJjZDU2NzZjZDAiLCJpYXQiOjE2MjkzNTY2NDkuMTY2OTc5LCJuYmYiOjE2MjkzNTY2NDkuMTY2OTgxLCJleHAiOjE2NjA4OTI2NDkuMTYzOTc1LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.pBFF1wgO2wSI3rCghdgRv7spnZyhI7Lth5Bep7PvfO_wpogmhwNtXL0FGi0rjWJQ48KXkouyK328HrGwP4jKGFWr5Ju5BOPJqhOarvkfvwZUvmiQM4xQWbxcH06RJCLhWz7ds3lwjHfRC2_FSUUuiO2dnWstTsRYzhjIQFeED1hr1vzXDoDzOYhzWH3D17mSZsdpZ3HyuIcAdjOH2EZidob95NWj1ap7hrAY9pzD__R5nrhQ_z49VLLnqOesO8yskzYxcft-LcNBs2JzJbjX2O5tcgc7p52zZHBwoeiFVx2YuNvTZKe3G7s5hMRKAAoscI71Fu-1GDPR5rydZdH3a5tCfz3TunpBeBI-3zcMGy-a5aY3ZEVbHPsXd4fAeK0F1-0bEad1UIW0fhCIkYdIEoVnh2N21xwMJnrBEylN4jCQ8P6eIjjltww3h_QMyS6NNJ7jCYg6Xn0dKAn1uomylvuqEcZk72Cd0I2fDf6Nzz9bnuqtFdL6NO5NrPCknzgUJaZ_678K1m93e8cQaIYVHgWqA4cs0RrRKPgEvKrl58xCw9Yea-YwOgsahrz47r21mIHWjWhRbt2yZcZNAsuYwPS6i1TyAC_FSYM-SiRinVhcG6W_JsMeGp_XqkJ5TrvAda18TO-UNhXf9kaWORqnjjKzs3jZv6xBxwn64TNhA04",
    "refresh_token": "def50200965fc8c72f1e28b96fd2c36c72708d30f5f8effbe976f4db71663cc7fd29b22f6103d0907be342491bbf5906e8cdcbbf5d743426d8fa3df2a27610bf08224836deb9a3b4976a71488dacbb6d80ab36c2ee65670b9c6b0ef08a2c4f29e4911a478017bd8a4c4080cae16929e89452bc5bfd53adb263261e94448695843283ec4fe344ff17f7ace2e874076795389b497849dabac373c750cb10dee8dc1d9cc8d1a5b0fde02222ba61761ab6ca88061b53abdb5dc068bfe2948ba4d681c5e6605f76bfccc993692899282d3afd9832341d4c0de46aaefc493753c39982471536be92e1373dbe1a61155766ecf11e8dffda1b674a2601eb91630648694a96713f078eec60d15c51af611876f3993d1a092c212f59ffc14a605a8b7f3e4a5f526e8e310de501503208d009bffb6243392d2f5f175630db68781671c50217368eb17102d1ccc7c18ceb445653042786a04ab7538c094e82e715bf9460394913"
    }
--------------------------------------------------

Overriding Default Models
You are free to extend the models used internally by Passport:

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    // ...
}
--------------------------------------------------
--------------------------------------------------
--------------------------------------------------
--------------------------------------------------
Force regenerating new keys
php artisan passport:keys --force

--------------------------------------------------
    


php artisan make:middleware Cors

php artisan passport:install
$ php artisan serve


-----------------------
Test in Postman
-----------------------
http://127.0.0.1:8000/api/auth/register
{
	"name": "Mojtaba Rahbari",
	"email" : "mojtaba.work1980@gmail.com",
	"password": "freedom"
}
{
    "message": "Successfully created user!"
}

---------------------------------------------
---------------------------------------------

http://127.0.0.1:8000/api/auth/login
{
	"email" : "mojtaba.work1980@gmail.com",
	"password": "freedom"
}
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzE4NDUxODQ3MGY1ZjYyNDFiNDljMjg4NDliNDk1MTBhNmFlOWFhZGNiNjMxOGJjOWEwNWQ3OGI3ZjQ5NTE2N2NlZWM1NGIyMTMyZWM3MjkiLCJpYXQiOjE1ODc2MDkwMTIsIm5iZiI6MTU4NzYwOTAxMiwiZXhwIjoxNjE5MTQ1MDEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.1CtP0pnV05nQRoyF0g_W0x3kIDsqrCD1g1DNj0OWpxABlAsuuzMb4eWPF7ZbfHfreppj_LZdAC4d6cCRghE5i3QWJY8rc1XLKmwAHDYgWC8Bjxnf0J_nJrtmInRc46gP8uzn5wmHx17NRcWttCsNgdcPBneSUqygYRP8KeeG1emXGU9DnlrWpb6nr7SlwI6UVYa5Vn5Lf9WulvBgPvxL8Ag7jdq8WRrrUkmsEpfzXgmj7YL4_Jm6GlcSRDCJWFjC_nB4f54-BzOlFnQA20a2XqkzbNodYH3NLGoxkZq56FOB5PH4MbdnNloVNoio6qpgqik910oBn2pDPzP0qO1fysxQ3Bqso77ypBLrHDRaJGu2bPUbIZp-M41N4MINOJMC9P9JaPGXz17fEa3bXFfaQ6X479xe_zA6Ilr0LVzgKDNS3vaEwPbwQFDqusCCNdJvtqTcQq8GVek_4Mp_FNJqI84J-yw5A-WLoJIQp9Af9blf5HyR8obTD11xk1wumQeobUuVKm64qr4pnr6Qd3ZilZ5x2ZnMXXYNuPefSkcYwZCP5z5HD75WMsd5PEwaLUDPxVp_DGOITSdXPtu3E5z3sTofBH1klt0JeRSOMb_s5vGEXXru1gbN4Tt-GuRW1q5ktjBdMsqw8mgGi0DOvrLT3ZXu5UVRHKU3DzC2d2Yp318",
    "token_type": "Bearer",
    "expires_at": "2021-04-23 02:30:12"
}



==============================================
## Purging Tokens
# Purge revoked and expired tokens and auth codes...
php artisan passport:purge

# Only purge revoked tokens and auth codes...
php artisan passport:purge --revoked

# Only purge expired tokens and auth codes...
php artisan passport:purge --expired


==============================================
# Customizing The Username Field
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
==============================================
New client created successfully.
Client ID: 3
Client secret: hVNL8sH2tRJwNe8ZwcDW2oVh4XjYUKJxBYmgYmPj


==============================================
assign new client to an user with redirect callback url
php artisan passport:client

==============================================


==============================================
==============================================
==============================================
==============================================
+--------+----------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+--------------+
|        | GET|HEAD | /                                       |                                   | Closure                                                                   | web          |
|        | POST     | api/auth/login                          | login                             | App\Http\Controllers\Auth\AuthController@login                            | api 
|        | GET|HEAD | api/auth/logout                         |                                   | App\Http\Controllers\Auth\AuthController@logout                           | api,auth:api |
|        | POST     | api/auth/register                       |                                   | App\Http\Controllers\Auth\AuthController@register                         | api          |
|        | GET|HEAD | api/auth/user                           |                                   | App\Http\Controllers\Auth\AuthController@user                             | api,auth:api |
|        | GET|HEAD | api/user                                |                                   | Closure                                                                   | api,auth:api |
|        | POST     | oauth/authorize                         | passport.authorizations.approve   | Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve  | web,auth     |
|        | GET|HEAD | oauth/authorize                         | passport.authorizations.authorize | Laravel\Passport\Http\Controllers\AuthorizationController@authorize       | web,auth     |
|        | DELETE   | oauth/authorize                         | passport.authorizations.deny      | Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny        | web,auth     |
|        | POST     | oauth/clients                           | passport.clients.store            | Laravel\Passport\Http\Controllers\ClientController@store                  | web,auth     |
|        | GET|HEAD | oauth/clients                           | passport.clients.index            | Laravel\Passport\Http\Controllers\ClientController@forUser                | web,auth     |
|        | PUT      | oauth/clients/{client_id}               | passport.clients.update           | Laravel\Passport\Http\Controllers\ClientController@update                 | web,auth     |
|        | DELETE   | oauth/clients/{client_id}               | passport.clients.destroy          | Laravel\Passport\Http\Controllers\ClientController@destroy                | web,auth     |
|        | GET|HEAD | oauth/personal-access-tokens            | passport.personal.tokens.index    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser   | web,auth     |
|        | POST     | oauth/personal-access-tokens            | passport.personal.tokens.store    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store     | web,auth     |
|        | DELETE   | oauth/personal-access-tokens/{token_id} | passport.personal.tokens.destroy  | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy   | web,auth     |
|        | GET|HEAD | oauth/scopes                            | passport.scopes.index             | Laravel\Passport\Http\Controllers\ScopeController@all                     | web,auth     |
|        | POST     | oauth/token                             | passport.token                    | Laravel\Passport\Http\Controllers\AccessTokenController@issueToken        | throttle     |
|        | POST     | oauth/token/refresh                     | passport.token.refresh            | Laravel\Passport\Http\Controllers\TransientTokenController@refresh        | web,auth     |
|        | GET|HEAD | oauth/tokens                            | passport.tokens.index             | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser | web,auth     |
|        | DELETE   | oauth/tokens/{token_id}                 | passport.tokens.destroy           | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy | web,auth     |
+--------+----------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+--------------+


+--------+---------------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+--------------+
| Domain | Method        | URI                                     | Name                              | Action                                                                    | Middleware   |
+--------+---------------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+--------------+
|        | GET|HEAD      | /                                       |                                   | Closure                                                                   | web          |
|        | POST          | api/auth/login                          | auth.login                        | App\Http\Controllers\API\AuthController@login                             | api          |
|        | POST          | api/auth/register                       | auth.register                     | App\Http\Controllers\API\AuthController@register                          | api          |
|        | POST          | api/login                               | login                             | App\Http\Controllers\API\AuthController@login                             | api          |
|        | HEAD|GET      | api/oauth/clients                       | passport.clients.index            | App\Http\Controllers\API\ClientController@forUser                         | api,auth:api |
|        | POST          | api/oauth/clients                       | passport.clients.store            | App\Http\Controllers\API\ClientController@store                           | api,auth:api |
|        | DELETE        | api/oauth/clients/{client_id}           | passport.clients.destroy          | App\Http\Controllers\API\ClientController@destroy                         | api,auth:api |
|        | PUT           | api/oauth/clients/{client_id}           | passport.clients.update           | App\Http\Controllers\API\ClientController@update                          | api,auth:api |
|        | POST|GET|HEAD | api/user                                | details                           | App\Http\Controllers\API\AuthController@user_detail                       | api,auth:api |
|        | POST          | oauth/authorize                         | passport.authorizations.approve   | Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve  | web,auth     |
|        | GET|HEAD      | oauth/authorize                         | passport.authorizations.authorize | Laravel\Passport\Http\Controllers\AuthorizationController@authorize       | web,auth     |
|        | DELETE        | oauth/authorize                         | passport.authorizations.deny      | Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny        | web,auth     |
|        | GET|HEAD      | oauth/clients                           | passport.clients.index            | Laravel\Passport\Http\Controllers\ClientController@forUser                | web,auth     |
|        | POST          | oauth/clients                           | passport.clients.store            | Laravel\Passport\Http\Controllers\ClientController@store                  | web,auth     |
|        | DELETE        | oauth/clients/{client_id}               | passport.clients.destroy          | Laravel\Passport\Http\Controllers\ClientController@destroy                | web,auth     |
|        | PUT           | oauth/clients/{client_id}               | passport.clients.update           | Laravel\Passport\Http\Controllers\ClientController@update                 | web,auth     |
|        | POST          | oauth/personal-access-tokens            | passport.personal.tokens.store    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store     | web,auth     |
|        | GET|HEAD      | oauth/personal-access-tokens            | passport.personal.tokens.index    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser   | web,auth     |
|        | DELETE        | oauth/personal-access-tokens/{token_id} | passport.personal.tokens.destroy  | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy   | web,auth     |
|        | GET|HEAD      | oauth/scopes                            | passport.scopes.index             | Laravel\Passport\Http\Controllers\ScopeController@all                     | web,auth     |
|        | POST          | oauth/token                             | passport.token                    | Laravel\Passport\Http\Controllers\AccessTokenController@issueToken        | throttle     |
|        | POST          | oauth/token/refresh                     | passport.token.refresh            | Laravel\Passport\Http\Controllers\TransientTokenController@refresh        | web,auth     |
|        | GET|HEAD      | oauth/tokens                            | passport.tokens.index             | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser | web,auth     |
|        | DELETE        | oauth/tokens/{token_id}                 | passport.tokens.destroy           | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy | web,auth     |
+--------+---------------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+--------------+


GET oauth/authorize : 
Redirecting For Authorization
When receiving authorization requests, Passport will automatically display a template to the user allowing them to approve or deny the authorization request.
The redirect_uri must match the redirect URL that was specified when the client was created.

/oauth/token
After Authorization: code and state will be generate
http://127.0.0.1:8000/?welcome=mydear&code=def502003e4f947e528a5c64451ac57f439c81f9d05d8cf4ceee8a816b72cb52b4d4e19ea5f1e4c325283e6fca3b8879a85db9d83d763fc9078d5334af982716c3e379daca654924d19b76b06e74b4d8471f048901e45c0c8503284891c6b315037912ecde806decea1e57c7fe2cb62264b5baa0400c72d1c8ce6d87391e03c1152aedcffe6581849c503856efc9fd8f0cc55af8302a8bcb5d75322352ce750d2a95a1373b39ffae0242bfd771de25d45d872b9c63e2fada2ce444448a3753e44a45c6023f3ff9b1486bde5fc761f21d2633308af61ada8305e30f4318845d242f85df1440601dffcd15cbd3e0c3c2155ccf7cf8c43693865526662432971d0007e4a2d938fdc15f633321b77fad0ff1b140e67d2edb6afa73040689058a077cdc62a258e918977e1184092e8b21250e90fea7c42b2375bf5b03f19a47abcb73b84d13727173627d3aa540c1c52be01a71a6d30243edc319cca8837619eeaf6bc6f27137d602&state=MY-RANDOM-STATE-STRING

Step 1) Build Url and redirect by below address
http://localhost:1359/laravel/laravel-passport/laravel7_passport_api-master/public/redirecting_for_authorization
    Build Url and redirect by below address:
    http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/oauth/authorize?client_id=4&redirect_uri=http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/converting_authorization_codes_to_access_tokens&response_type=code&scope=&state=OmIngYw38QL9nYj36EALQoTqsTidMDHsBG1RLJsm
    
    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);
    return redirect('http://your-app.com/oauth/authorize?'.$query);

Step 2) Create Token by generated code
http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/converting_authorization_codes_to_access_tokens?code=def50200430c194bcc7739c9b5a72e81d9e98da1035e73c4bbc5b5e8e5ad6d7fb0715755c29a0926171c1b0bb3061510795a15845f815ef1e227edb387976f1bfc1a972a85ebf6f1bf74c20c9fd7fbb3bf041077d69bb006374eb59890c938711388665ac7ea12a109c3cfb728dea419c198bbeb6b7cc7e755eb4a573ca6baa126c1794b2344fdf187bd3305d13f682c0db9149be9bb19e6ca5f6be941f32c8eef91f64a654f74c54f53557c649ecc6b3b79a5f8cc94e8dd62421b052b33b50a20e67cfa5582a104a20bef07e4651cb81a6c83c51bff34cfe8dcc504979a3288859ae32baa1db448165eae3bfe3f26189ba8f9993f787b5241a61ca5fa1dd4f81901fd578c07ed9ee5d4137b74071cca589f053683e1fa34fd1a3bac62d4513c26d527ad293f5526849e6ecc52e2e9ff279e5eb0f58b3d60926f31c1397063a33af1e034c49286931f2d99d90ee92758c286c45fb016c99f3746b5f6b4dbedd765bc0d250345c9adac6724c907b570d8632ba7617ca5d41f259d36dbeab47e3dd8187ec8430500ee5c3b110e55d323ccf5b075932421ee8a2c9cb0cb129a90015439c2b8c56822713b9a8045769067d96ca2c5f8729071e0111dad16a7a69639f1f5a50086bcee&state=jKzrfwlcxcQqN1ymbS6JFr3lhVM44sxiPS9DSxGc
$response = $http->post('http://your-app.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'redirect_uri' => 'http://example.com/callback',
            'code' => $request->code,
        ],
    ]);
Response:
{"token_type":"Bearer","expires_in":1296000,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiNzM0YjIyNDA4Zjk1NTFjMjVjYTM0NWU5ZjU5NzMzN2QzMzRhOTMxNjQ4ZWVkMTA5YzYyYzhmNzE4OWVlOTFlMzYwZmJmMjY5ZGQ1YTNiZGIiLCJpYXQiOjE1ODc5MDQyODgsIm5iZiI6MTU4NzkwNDI4OCwiZXhwIjoxNTg5MjAwMjg4LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.mczRkQyzEVKstVT-V3lh4AhkW5fDIzyPxLXJoiA7RabZ99sP28uQHSsOOrE3Alor4IX8W1WuzHvXa7W_3hie1Laesbn0r9oZJgq7wxzchkbtDbiVbXWBgDIUM-sf0PLt0w2VkUjkB0cPSxrErTwgJ8noVEleaUfLkGfCYqpPkhTVrFJ8pBtUV937YctWfT6_iwuuUzJe5qBKrxs2c8tEOCpjhE8B0FnkGhkLfke6hHcBU7dCr-wwTVQ6JJptXapGM8MkkrvzpXecDRhPgvCYmzSne8LYxBoiv_wHV0UPwplIkWcU16l_avtGOm8b7zV_ftQAQcWoD6sRtQvxoUZEDIBWiv04NWiCPqsDYoKjpIAjC7BxsUvo_ZrmLu58MfSj35fT_HBnZkT0BREH2QtD7giQK2y4bWMYnfSVFIi0lif3wgdagls0Wq3i87rM9Nitm4gs642PtUu2jdpc6tP6grlhC7CsdN68MzhYxffJrk9MAI2VxkV3TayFUfHz_tW16hAjIJ9OaJVYLXAlL_3qptBAkmLjDDEbGTljaWmEE0RKQpC8s15vrE1Rc80B5QkB1YEirmO4Q5VinfwoycZG3I8-zBkLngkA2BeVH0PmhRby3URCZ77vzeEJY0snirzspXpzk3Kk2J_1NL_XnRh191I89zH7BtOpr8J3_oGVdBA","refresh_token":"def50200f340e8d1dd963797b3944bf34e692f7dca7085195ce4a9797b11a34f65c2e3648a91140f6cd241e0ba11edf9749e3dac64a0e13a7ba1e7ab009a6f7d6b7b917c71b9ab45622405b314d48156db2a3df16979ffc5ed3e4601a01a9470f091fde94a7b820887f2b92f6bd530943bfd6839bd677388e64ad40963b396241af8d99cf6d2f752002625dc4e01c7b3ecb4b1ed8a887c986299a7813cb3559217dbf9befe2ecd7b054d5c22af95bb64db47e578167a8dc5ffa40076366b7aa0577701922cf7e2ac69664e10e0bbc344925d6b1d870bd009064145a16ccafdf53e8b13d389f6bc3d39f605a45ba824ac2f27f0d7dc17518f5e31b4820542a0dd12ce183fc9d187e53f0d5d8e10aba013e35964c94f9628c86a5ad232e72f5c029599ea3863f371d7edb31d66cd7df66601c4fbf1e08c40551ebb427c0528fe189c7a4021516b7367aa6e8de5325347ed05a96dd36ea2af1276c30dec631b5c47e713"}




Step3) Give some params and specially refresh_token and get new token
http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/refreshing_tokens
$response = $http->post('http://your-app.com/oauth/token', [
    'form_params' => [
        'grant_type' => 'refresh_token',
        'refresh_token' => 'the-refresh-token',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'scope' => '',
    ],
]);
Response:
{"token_type":"Bearer","expires_in":1296000,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiNGM1MzhhODRlMDYyYTY3MmZjYTJkY2EyMjMxY2E2YzVmMzIxNWY0OGZiNzc1Y2U1ZmZmNWVjNGI0MzQ0NzQyY2MwMWY1N2RhNDNiNWQyZjYiLCJpYXQiOjE1ODc5MDU0ODYsIm5iZiI6MTU4NzkwNTQ4NiwiZXhwIjoxNTg5MjAxNDg2LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.qY3Dq4aoqjNkvqNQzGA2_Xni2oIWRgrMLeLqe53T--GTiiCEHQbmBQC6DZK2RdIX25KB0uiwNd3ebO509sdkOzmr7aCwzEkTDcn2LBJrJvFygDcjswJi9x6AtV9j3AMqlcvr7sLcmqcyNK491B8b2uY9Cl-Tm4hmL7CBY4NUfN2bxZnH2TyDW1imK9KV-iIIhoC_O7KxNBWsREkUGK_DO4tDaF1fesfEwB-I-VD5DHHOSl0_uiHQ51IlQSLK2rhMgwrCS0jMkjj_VUrvSfnRfi3UC9uUUeaUlrLarw6J0wgeq-vhq-cqiyDz_vfHuzR_aDHe25COOoCe3VnbQncK2yf7idmbAobP2YyTDn1vlJyndVa2rT8ZmldsULNd19qL7gEOCbYvFoXaSfA1tTifuhxbMClgxbECIil-gPMX4nppww5_Yy9OjJVvufJOgCjLiftxUJrONSeyERqhGvdY-xrO_Bz6ipeShKSvVLdSBHH4WYJRy4F8x33oIDPiFouqg_JpgR3ZkvwiGG1VtJ1BJDckrlosRqOTWqfGNveIQudEe9lKLYd37vV1R-n8P-r0yP932MlBWiZI4vkf0PpJP5YwgzXUs1zUiGepsqZQDxgnGCmk14UwYrj4Y1WB4-eoEmNNdo5tmOejRgQr8panfi5p2P3QVY1I_WPU8x242ZY","refresh_token":"def50200ea9ebb1f6930bcba8ef15a6b351755b9c69e9eac00db5c3df87e9d375114bd92a5f9ca2e43d3b32f8e8a66200d296f5d787381a32dc2585f0a3f934158b19c8cce6df536d75de2074775596ac36a21b5887160d65d52095909f4dcac01f0eedfd989c469d03e1d7fb1473dec095efaf41fd5eb64e95812488b03f9f0688706808ac597f9459a568e6e9ad6a61907402f5793e32c7df8801de15edfef791449a7bbd3818803b16299cbd156076f73ea496da63bc7b263fbe2ad649463d2add0353aad503f2bf44d7fe9c9bfdb9eb0f44dfb1799cd4c71e00eb297630326a18c166f5384f880d673b22ed7950d90802c20c4b058d939b16c786d90e7d366d96a98d15bed93fbf854261f0c64eb895e901dcd9f154e28c1e23824c308c8c8ce4097ab3de803137681891d3d7af9f29db88d17db2a51531dc1595aef97843d878d616c9578c5a99e7e81b1a16537a77fd041b6ec44d7ba2b6e280f9d1ea7458a"}





## Purging Tokens
    # Purge revoked and expired tokens and auth codes...
    php artisan passport:purge
    
    # Only purge revoked tokens and auth codes...
    php artisan passport:purge --revoked
    
    # Only purge expired tokens and auth codes...
    php artisan passport:purge --expired
    
    You may also configure a scheduled job in your console Kernel class to automatically prune your tokens on a schedule:
    app/Console/Kernel.php
    protected function schedule(Schedule $schedule)
    {
        ...
        $schedule->command('passport:purge')->hourly();
    }



======================================================
======================================================
======================================================
Authorization Code Grant with PKCE
The Authorization Code grant with "Proof Key for Code Exchange" (PKCE) is a secure way to authenticate single page applications or 
native applications to access your API. This grant should be used when you can't guarantee that the client secret will be stored confidentially or 
in order to mitigate the threat of having the authorization code intercepted by an attacker. 
A combination of a "code verifier" and a "code challenge" replaces the client secret when exchanging the authorization code for an access token.
Step 1) Creating The Client. Client without secret key
php artisan passport:client --public


Step 2) Build Url and redirect by below address
http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/pkce_redirecting_for_authorization

    Result before redirect:
        //http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/oauth/authorize?client_id=5&redirect_uri=http%3A%2F%2F127.0.0.1%3A1359%2Flaravel%2Flaravel-passport%2Flaravel7_passport_api-master%2Fpublic%2Fpkce_converting_authorization_codes_to_access_tokens&response_type=code&scope=&state=JlD9co8ehhkVR8vppvVS9Q1AIzAVkfM4MlEbsK6y&code_challenge=F9jWcvY4nWHpOQ63WoFWRD1B6v0H1-oVe6Mth438YfM&code_challenge_method=S256

    Below code in method:
    $request->session()->put('state', $state = Str::random(40));
    $request->session()->put('code_verifier', $code_verifier = Str::random(128));
    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $code_verifier, true))
    , '='), '+/', '-_');

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
        'code_challenge' => $codeChallenge,
        'code_challenge_method' => 'S256',
    ]);

    return redirect('http://your-app.com/oauth/authorize?'.$query);




Step 3)
http://127.0.0.1:1359/laravel/laravel-passport/laravel7_passport_api-master/public/pkce_converting_authorization_codes_to_access_tokens?code=def502003f0f2f1dcea10086231522a79c5bbc1ec1fa8a344b48a8167ca72a79e04163adc3c953b498db7ff05d7044a6354ab77a885cb687cab58c5adeb60a50494c12ac26282944d1494b72953c46e1f268205eb8472d23131861a6398d1b8bb817703c6fad2d976dbe74a4231e25b0a82a703ee48b272a34607a807b97e6d02c87db6fbe734d03fddc0c076087032caf6a450d5f76b7ffe80f4083fe9d0c9f594158a7687f2ddaa870dbfd6c845bca171b68d893d93b474cb2573807d15e6979c6947f5a5bb48d831e1860016d34e59bb22e8e724ceb6bd929acd414a934661e5743f9f6292a1ee2f2845e3f101f1d31e8fff8820c9b54af7e9f2914dc7a36cfe934f176a60c6e688dd0700f1886a27d46c64221cda6a43ee74c8ccd906b2f863aea41a0c6bdeafcc40e31f3c5754594ca84461a73fdfa2467a3c8cbe69a08809d6e69e7d2b0043782fb201106b912776dd11bdeae0a577bc7f7da8b0049d70f1e11f8f6f141d924d2bdfb5d601bb9b81a14ab385813c71f0cefba1db528f6d344f8b8397dbc382e0effb4fd36dc95d807f2431f2d7425aaf3c1d9690310b2e43242b48d03f55af7aea781c91e4128866684926752493f5f57962d641c036bcacf5c46f7b2e59095dbd0e130763611b85654bf5695f14e68c8c46e4668e31a5990347b6f7bf2720694bf0d3c5cf30c9a9c978c40a3c1&state=qXYHifLYMSBXcSncXoE7LTeUNth33qqFwtQxRrtg
below code in method:
$state = $request->session()->pull('state');

    $codeVerifier = $request->session()->pull('code_verifier');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $response = (new GuzzleHttp\Client)->post('http://your-app.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'redirect_uri' => 'http://example.com/callback',
            'code_verifier' => $codeVerifier,
            'code' => $request->code,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);

Response in json:
{"token_type":"Bearer","expires_in":1296000,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNDJiYzdlODIxODEyMDFlN2U4NzQ3MDE2NGU0MGRiZGRmODRkMDdiYmI5Yzk1NDExZWI1ODU5YWU2YWE3OGEzMzQ3YTc5OTM3MWFlNTY3NmEiLCJpYXQiOjE1ODc5MDc3NTQsIm5iZiI6MTU4NzkwNzc1NCwiZXhwIjoxNTg5MjAzNzU0LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.aCcx1P8j7Z5tGsjAIrAnLqGnLepv46zXDOB66FEb9CdJG-kM2MkMlr5IyFPeDt4NK8Nhhph1qHNM_Dv38O-tRWqZEb40XaKp3arnrP7go6KkNc4x0IVtR6ezSzA2QYUJw1ABop7eb_GBXeiPgApSr6WnSY62Y1HHZjGqiUkRlCwjCzA7Bwc5mgEO0wSXs4T-Ih8Kn_Cqdel76hAoYW-vzBW1snLDpG6B00kGZH1bnOmBqAzeYTDBVgg0L9NTup9l7lg33pDIYbr-Koab45hyn5mQ4Nd2tpKpdcLwD-gcWvd4MMWfu8EBcIoFxJOXcL7CSvM8uox0u0xggvhjIbwZBvpMY1UaTAR-umUrYzNVIRYTnT7yVhRTnUOE4p71qBM_yhl65udXr7HwXVv3nJGWnpyvLpQTpixVSd2Yn9vVT3E_uuA6mdOnmxPbf--LJ2ySL40ESOywT5EHb--eJG9N5tQOvPNy3gNz2PpcIbRDjUCb99YKHa_N08DoTGcFwUGnegHCiXkWuE8InSwLSBA3Mn104QNA7lyuAP6-UL-pCC5K6PfmjlAWcNfRJzSqbPpEOAeNehGH0TB2zRETUHj_p_jxL8oqFZqpyGEzei0BR7WENdzIMuS1PJd27UWgDwcDzi-EmrkwsVcvJ_14TsHiRYdrKo0jya1dGmcksU9AKoo","refresh_token":"def502000a0d8fa2cf8975feab2dba23ab5c2bc74aa1176a2561aac2cfe3e0a8b3ee5dffb109c6cdcc6d32a7603e31f095c4b1ffb1f38eb45ba01919e18d3ce29346b9da61061c4b63b27fc35cf19ad33ff5a82feef5074ad38728fd081062d4846c55948d0f6eaaef520b5a133b59ec0aeac319a799652aece8c4491590255805e5dd76608dcee4ca98e5a3fb1b44771d5b9e987bef1c7cf0a006f55cb5d2398aae26bb53b8cd743dc78d3449aeb6dce2cbd8fbceb053f16c1c21986635f36de6393ce82d844fde5e8089aa0386ed3375c45c7a9f3206d3f2604bd7f11ada8c88c4c16b62289cd833b3a804ce8932550b0d54e4711402fb19139322604202cb41a6f3ff60a3bcf2246fef260d003d7ac86852b7895416da919bca7601f378ae8c153303429a58e1e2a59aad35a3ed7a1a12757ae8880ea5a0e3476801cd2bbb65280485b6d5b73032889c15d18166001411b3d6f9f2b53a607f361d142fec58f5f8"}




======================================================
======================================================
Creating A Password Grant Client
Run below command:
     *  php artisan passport:install    OR    php artisan passport:client --password

    php code to handle:
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://your-app.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'username' => 'taylor@laravel.com',
            'password' => 'my-password',
            'scope' => '',
        ],
    ]);
    return json_decode((string) $response->getBody(), true);

response:
{"token_type":"Bearer","expires_in":1295999,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiZmJkOTQ4ZWY5ZmFmZTE4MDMxOTY0ZjQ5OGNhYWEzMTIwMmRmMTdkNjY4NmI2ZDAxOWJkODBjZWUxMjlmYzAzMDZjZWY1M2Y3YzFjM2VjZjgiLCJpYXQiOjE1ODc5MjcyMTcsIm5iZiI6MTU4NzkyNzIxNywiZXhwIjoxNTg5MjIzMjE2LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.t780OUhX4xOG4uLJ4K6FtELMNkd5KHqdxFfJK_VlBrgMV03JiGQvAANI4euQUOdpEB_hpS15BYqUIF1Uw0-tqwQ48K5VLX0-0aYfM-08LWffOTfoCa-lgPQ_6A_nge7UmAcGNkXBd45NLUV0RMKCCDinEgWr4xaQrXg0roXqTU9adU1N8AI8dqSXV3oyed2jyjGejL4fENfXu_MiHvWnVicYW6LgC0OBXchy4VbrFn07ZXSwRGm603vVAuyz-GfhqTG1b1g7H_ZGfK3LGXdtR_c-bdO1kAS89ZWW9ISq_cuiByMmrwzHdxBRxCfytpiNXqnJdVdqwE0Gx8WYHFWxFE6gyyEOEBYvgesbsyTtdcQQ9-JzeQz43Y2shNd3GYgQhXtO0rMPCaQXzbi8NeMXFJdj15ITSOdPCF_UCxO-9JxTQhbC1TMxel3VUZRzec2PReB6SniTEinMOka3Soa1dKWVjQp31IW5eTsw6Wz4os9t0VfnoL5yYSPw2s6vOwkar_p0VU7Lk6vnGGjx88OqC67zN2gNDBXyr1enjyBC9XjojcDY1NVaDMZDoPDvIRFS-_bWpHduo_A1L6dtyoVGr8EUnJM89yZ7LaDWD1LwjtaUoiZOjLH0DSGeSFyNSPmT9WnEknvEGH54_HnkUoMme8_Bm0XIcOjE-IgJF46QOS0","refresh_token":"def50200f5279f01c31e7cabc8dac722f7d773dd5df9e2adee69f6822ab50caae72c54c93279fe727fc2fba91cb5d052af35d7e67bd8becd5772c4b8596b64685a8e03f14db5b7c4d51ebc4d216e63b790cfc15c21ef69f90f79124ee31ff367db2a5fdf2a56a191b12b70857a1b3dc7838511fdb8eaec862fc7d3d8547e03a29818511f39054bf5240934c0b47f026165393c6a5c329c8681a82bc6a91102eddfa2ab59bf6e0f1cb2844e507fae4f9824e8754396bf2a1bc03134164036c35c0f45ca1974d404d7f685e56a3937ed375deebe773b7ef1f775ee935e12be4c6af7cbded76e2ee52d15e81a0d2c3164cb273145041942c0a58d66a4282f5bc8b0adeb98891a4c59ab6bd04dde48bd20ebd0a69480ae68a409c0d971da254a61d2b5986a78f37d88ed46138b3de89807d6791a2d7306e60084449f01d64158abb0ce0ca702c3b2cdecd7874f51d5eeead6282c4b5db80a392861a16495b6396aa33767"}



======================================================
======================================================

Customizing The Username Field
When authenticating using the password grant, Passport will use the email attribute of your model as the "username". However, you may customize this behavior by defining a findForPassport method on your model:

<?php
class User extends Authenticatable
{
   ....
   ....
   ....
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }


======================================================
Implicit Grant Tokens 
Getting token without any password or client secret
     * Step 1: in AuthServiceProvider.php file boot method -->     Passport::enableImplicitGrant();
     * Step 2 use below method:
     */
    public function implicit_grant_tokens(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));
        $query = 'client_id='. $this->client_id.
            '&redirect_uri='. $this->redirect_uri.
            '&response_type=token'.
            '&scope='.
            '&state=' .$state;

        return redirect(route('passport.authorizations.authorize') . '?'.$query);
    }

======================================================
======================================================
Personal Access Tokens

-- Creating A Personal Access Client
Step 1)  php artisan passport:client --personal
Step 2) add client ID to your AuthServiceProvider.php   
    If not specified, the last item will be considered!!!!!   
    Passport::personalAccessClientId(7);
Step 3) use below code in your method


    In login:
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if( auth()->attempt($credentials) )
          $user = Auth::user();
      
    In common way:
        $user = App\User::find(1);
    
    
    // Creating a token without scopes...
    $success['token'] = $user->createToken('PB-APP')->accessToken;

    // Creating a token with scopes...
    //$success['token'] = $user->createToken('My Token', ['place-orders'])->accessToken;

    return response()->json(['success' => $success], 200);
  
  
  Result : 
  {"success":{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiMTMzMWU3OTI5ZjM4NDJlODQzMWRmYWM3Zjk5NmUxZGRlODU2OWZhYjJkNWIxMzk2MDYzMGQ1MjRiZWY1MGJhM2YwODVkMDE2ZTExMzdhOTUiLCJpYXQiOjE1ODc5NDkzNjEsIm5iZiI6MTU4Nzk0OTM2MSwiZXhwIjoxNjAzNzYwNTYwLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.A0KodiRNXnKfdNlKOXc-1n-3kOYsZb0VnbVxLJjGpG2now-4ho3y1FrobXCVh6kv3eaCx6zBkbbnwsxyaWcg9y_sjVHpB1l_p0nWJ_p5QgF_p5GKJoL23TCgCge1eWjn9yX3Dmf30enAo3542aEZ2scUOwhtWscmTJmsuT3HgEAHHhwi9fbEFhsJ4MK82uJYIF1VzYVSGu_7jguRp1G6eoW3u8uLS2Z6wDTmhr_4PLANJlMwvRVY4Ur-4h4F91VeWoIqcDZCioJ0CAt4Cd8TfBVGRpeLDHKgxhdHXNN8rrwVeVWKj8KdkC7LgaTsavTXPS1IcnP2Zh1DSCITaZRmxdsp6ftIo2k-4_FsJVXBUUbw1mRM27zj6x6ADruTsnfDys2MzkL_kg_puhVmpwkrDXnd8bf3b4mBZSdksfsnIsmMZ3_h--l7mEU07aeWp_RgFlc5BZZu8kRoVqpdSLAP06lHguLQ39qsqfimUATnIhDjAYYRREIYzHKcwBw4lvp3fPMC2O91egD10yfxR7XYSxxnm3kNuxhF67_FfBVC_DdUljL-znfrxoUYV3SjHYicMA7HdIL4Ta81vvKyQg1viVjheG20UhlF0KRw2qXFzI1i8BN34RnS7MLW1H4vtRJQMu_LIsKlz8op0GFUn2pxK9h157shoiExNEEBCubbJrI"}}
======================================================
Revoke and prune old tokens by event provider

Passport raises events when issuing access tokens and refresh tokens. You may use these events to prune or revoke other access tokens in your database.
app/Providers/EventServiceProvider.php
    protected $listen = [
        ...
        ...
        //Passport raises events when issuing access tokens and refresh tokens. You may use these events to prune or revoke other access tokens in your database.
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\RevokeOldTokens',
        ],

        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'App\Listeners\PruneOldTokens',
        ],
    ];
======================================================
======================================================
======================================================
======================================================
Passport multi guard in api
https://packagist.org/packages/smartins/passport-multiauth
https://github.com/hamedov93/passport-multiauth
https://github.com/laravel/passport/issues/982
https://stackoverflow.com/questions/52851208/laravel-passport-multiple-authentication-using-guards

