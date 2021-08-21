<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:15 PM
 */

return [
    'authors' => [
        'actions' => [
            'index' => 'Information list',
            'create' => 'Insert new information',
            'edit' => 'Update information',
            'delete' => 'Delete information',
        ],
        'labels' => [
            'id' => 'ID',
            'image_url' => 'Image',
            'slug' => 'Address bar title',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
            'priority' => 'Priority',
            'created_by' => 'Created by',
            'updated_by' => 'Update by',
            'deleted_by' => 'Delete by',
            'published_at' => 'Published date',
            'created_at' => 'Creation date',
            'updated_at' => 'Edit Date',
            'deleted_at' => 'Deleted Date',
            'actions' => 'Actions',
        ],
        'help_texts' => [
            'priority' => 'The larger number has a higher priority',
        ],
    ],

    'books' => [
        'actions' => [
            'index' => 'Information list',
            'create' => 'Insert new information',
            'edit' => 'Update information',
            'delete' => 'Delete information',
        ],
        'labels' => [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'image_url' => 'Image',
            'slug' => 'Address bar title',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'status' => 'Status',
            'priority' => 'Priority',
            'created_by' => 'Created by',
            'updated_by' => 'Update by',
            'deleted_by' => 'Delete by',
            'published_at' => 'Published date',
            'created_at' => 'Creation date',
            'updated_at' => 'Edit Date',
            'deleted_at' => 'Deleted Date',
            'actions' => 'Actions',
        ],
        'help_texts' => [
            'priority' => 'The larger number has a higher priority',
        ],
    ],


    'commons' => [
        'messages' => [
            'no_data' => 'No record found for display.',
            'successes' => [
                'created' => 'The requested record was successfully recorded.',
                'updated' => 'The requested record has been successfully updated.',
                'deleted' => 'The requested record was successfully deleted.',
                'restored' => 'The requested record has been successfully returned.',
                'status_changed' => 'Your record status has been successfully changed.'
            ],
            'error' => 'Can not register the desired operation.'
        ],

    ],
];
