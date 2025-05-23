<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'images_brand' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_brand'),
            'url' => env('APP_URL').'/storage/images_brand',
            'visibility' => 'public',
            'throw' => false,
        ],
        'images_category' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_category'),
            'url' => env('APP_URL').'/storage/images_category',
            'visibility' => 'public',
            'throw' => false,
        ],
        'images_product' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_product'),
            'url' => env('APP_URL').'/storage/images_product',
            'visibility' => 'public',
            'throw' => false,
        ],
        'main_banner' => [
            'driver' => 'local',
            'root' => storage_path('app/public/main_banner'),
            'url' => env('APP_URL').'/storage/main_banner',
            'visibility' => 'public',
            'throw' => false,
        ],

        'images_page' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_page'),
            'url' => env('APP_URL').'/storage/images_page',
            'visibility' => 'public',
            'throw' => false,
        ],
        
        'images_blog' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_blog'),
            'url' => env('APP_URL').'/storage/images_blog',
            'visibility' => 'public',
            'throw' => false,
        ],
        'images_author' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_author'),
            'url' => env('APP_URL').'/storage/images_author',
            'visibility' => 'public',
            'throw' => false,
        ],

        
        'images_site' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images_site'),
            'url' => env('APP_URL').'/storage/images_site',
            'visibility' => 'public',
            'throw' => false,
        ],
        
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
