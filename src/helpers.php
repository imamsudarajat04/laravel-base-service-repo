<?php

if (!function_exists('service_repo')) {
    /**
     * Get the ServiceRepo instance.
     *
     * @return \Imamsudarajat04\LaravelBaseServiceRepo\ServiceRepo
     */
    function service_repo()
    {
        return app('servicerepo');
    }
}

if (!function_exists('make_service')) {
    /**
     * Make a service instance.
     *
     * @param string $serviceClass
     * @param string|null $repositoryClass
     * @return \Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceService\BaseServiceInterface
     */
    function make_service(string $serviceClass, string $repositoryClass = null)
    {
        return service_repo()->make($serviceClass, $repositoryClass);
    }
}

if (!function_exists('make_repository')) {
    /**
     * Make a repository instance.
     *
     * @param string $repositoryClass
     * @param string|null $modelClass
     * @return \Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface
     */
    function make_repository(string $repositoryClass, string $modelClass = null)
    {
        return service_repo()->makeRepository($repositoryClass, $modelClass);
    }
}
