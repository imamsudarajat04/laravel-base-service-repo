<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Service Directory Path
    |--------------------------------------------------------------------------
    |
    | Specifies the target directory path where service classes will be generated.
    | Default is set to "app/Services".
    |
    */
    "target_service_dir" => "app/Services",

    /*
    |--------------------------------------------------------------------------
    | Repository Directory Path
    |--------------------------------------------------------------------------
    |
    | Specifies the target directory path where repository classes will be generated.
    | Default is set to "app/Repositories".
    |
    */
    "target_repository_dir" => "app/Repositories",

    /*
    |--------------------------------------------------------------------------
    | Model Namespace
    |--------------------------------------------------------------------------
    |
    | Defines the root namespace for your application's models.
    | This namespace will be used as the base for repository model references.
    | Default is set to "App\Models".
    |
    */
    "model_root_namespace" => "App\\Models",

    /*
    |--------------------------------------------------------------------------
    | Base Repository Class
    |--------------------------------------------------------------------------
    |
    | Specifies the parent class that all generated repositories will extend from.
    | This class should contain common repository methods and implementations.
    | Default is set to "Imamsudarajat04\LaravelBaseServiceRepo\BaseRepository".
    |
    */
    "base_repository_parent_class" => "Imamsudarajat04\\LaravelBaseServiceRepo\\BaseRepository",
];