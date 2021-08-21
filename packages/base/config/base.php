<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */
return [
    'extra_provider' => [
        Publisher\Providers\ModuleProvider::class,
    ],

    'extra_alias' => [
        'Hashids'     => Vinkla\Hashids\Facades\Hashids::class,
    ],
    'settings' => [
        'app_name'                    => env('APP_NAME'),
        'app_key'                     => env('APP_KEY'),
        'app_url'                     => env('APP_URL'),
    ]
];
