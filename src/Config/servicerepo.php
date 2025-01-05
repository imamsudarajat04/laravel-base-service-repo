<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Service Directory Path
    |--------------------------------------------------------------------------
    |
    | Specifies the target directory path where service classes will be generated.
    | By default, it is set to "app/Services". Nested directories are supported,
    | and the generated services will follow the folder structure provided in
    | the command argument.
    |
    */
    "target_service_dir" => "app/Services",

    /*
    |--------------------------------------------------------------------------
    | Repository Directory Path
    |--------------------------------------------------------------------------
    |
    | Specifies the target directory path where repository classes will be generated.
    | By default, it is set to "app/Repositories". Nested directories are supported,
    | and the generated repositories will follow the folder structure provided
    | in the command argument.
    |
    */
    "target_repository_dir" => "app/Repositories",

    /*
    |--------------------------------------------------------------------------
    | Model Root Namespace
    |--------------------------------------------------------------------------
    |
    | Defines the root namespace for your application's models. This namespace will
    | be used as the base when generating references to models in the repositories.
    | By default, it is set to "App\Models".
    |
    */
    "model_root_namespace" => "App\\Models",

    /*
    |--------------------------------------------------------------------------
    | Base Repository Class
    |--------------------------------------------------------------------------
    |
    | Specifies the parent class that all generated repository classes will extend from.
    | This class should contain common methods or logic that apply to all repositories.
    | By default, it is set to "Imamsudarajat04\LaravelBaseServiceRepo\BaseRepository".
    |
    */
    "base_repository_parent_class" => "Imamsudarajat04\\LaravelBaseServiceRepo\\BaseRepository",

    /*
    |--------------------------------------------------------------------------
    | Base Service Class
    |--------------------------------------------------------------------------
    |
    | Specifies the parent class that all generated service classes will extend from.
    | This class should contain common methods or logic that apply to all services.
    | By default, it is set to "Imamsudarajat04\LaravelBaseServiceRepo\BaseService".
    |
    */
    "base_service_parent_class" => "Imamsudarajat04\\LaravelBaseServiceRepo\\BaseService",
];
