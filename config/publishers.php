<?php
/**
 * config\publishers.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:10 PM
 */

return [
    'authors' => [
        'model' => 'Publisher\Models\Author',
        'table' => 'authors',
        'primary_key' => 'id',
        'hidden' => [],
        'visible' => [],
        'guarded' => ['*'],
        'slug' => ['first_name', 'last_name'],
        'dates' => ['created_at', 'updated_at', 'deleted_at'],
        'appends' => ['route_key', 'public_key', 'full_name', 'status_trans'],
        'fillable' => ['slug', 'image_url', 'first_name', 'last_name', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'],
        'api_columns' => [
            'backend_all' => ['route_key', 'public_key', 'slug', 'image_url', 'first_name', 'last_name', 'full_name', 'status', 'status_trans', 'created_by', 'created_at'],
            'backend_list' => ['route_key', 'public_key', 'image_url', 'first_name', 'last_name', 'full_name', 'status', 'status_trans', 'created_by', 'created_at'],
            'backend_limited' => ['route_key', 'public_key', 'image_url', 'first_name', 'last_name', 'full_name', 'status', 'status_trans', 'created_by', 'created_at'],
            'meta_common' => ['success', 'message', 'status', 'code']
        ],
        'casts' => [],
        'encrypt' => ['id'],
        'search' => [
            'id' => '=',
            'slug' => 'like',
            'first_name' => 'like',
            'last_name' => 'like',
        ],
    ],

    'books' => [
        'model' => 'Publisher\Models\Book',
        'table' => 'books',
        'primary_key' => 'id',
        'hidden' => [],
        'visible' => [],
        'guarded' => ['*'],
        'slug' => ['title'],
        'dates' => ['created_at', 'updated_at', 'deleted_at'],
        'appends' => ['route_key', 'public_key', 'status_trans'],
        'fillable' => ['author_id', 'slug', 'image_url', 'title', 'description', 'price', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'],
        'api_columns' => [
            'backend_all' => ['route_key', 'public_key','author_id', 'slug', 'image_url', 'title', 'description', 'price', 'status', 'status_trans', 'created_by', 'created_at'],
            'backend_list' => ['route_key', 'public_key', 'author_id', 'image_url', 'title', 'description', 'price', 'status', 'status_trans', 'created_by', 'created_at'],
            'backend_limited' => ['route_key', 'public_key', 'author_id', 'image_url', 'title', 'description', 'price', 'status', 'status_trans', 'created_by', 'created_at'],
            'meta_common' => ['success', 'message', 'status', 'code']
        ],
        'casts' => [],
        'encrypt' => ['id'],
        'search' => [
            'id' => '=',
            'slug' => 'like',
            'title' => 'like',
            'description' => 'like',
        ],
    ],


    'settings' => [
        'maximum_page_size' => 20,
        'maximum_limit_size' => 1000,
    ]
];
