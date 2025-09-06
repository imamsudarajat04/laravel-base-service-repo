<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Imamsudarajat04\LaravelBaseServiceRepo\BaseService make(string $serviceClass, string $repositoryClass = null)
 * @method static \Imamsudarajat04\LaravelBaseServiceRepo\BaseRepository makeRepository(string $repositoryClass, string $modelClass = null)
 * 
 * @see \Imamsudarajat04\LaravelBaseServiceRepo\ServiceRepo
 */
class ServiceRepo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'servicerepo';
    }
}
