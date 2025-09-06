<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo;

use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceService\BaseServiceInterface;
use Imamsudarajat04\LaravelBaseServiceRepo\Contracts\InterfaceRepository\BaseRepositoryInterface;

class ServiceRepo
{
    /**
     * The container instance.
     */
    protected Container $container;

    /**
     * Create a new ServiceRepo instance.
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Make a service instance.
     */
    public function make(string $serviceClass, string $repositoryClass = null): BaseServiceInterface
    {
        if ($repositoryClass) {
            $repository = $this->container->make($repositoryClass);
            return $this->container->make($serviceClass, ['repository' => $repository]);
        }

        return $this->container->make($serviceClass);
    }

    /**
     * Make a repository instance.
     */
    public function makeRepository(string $repositoryClass, string $modelClass = null): BaseRepositoryInterface
    {
        if ($modelClass) {
            $model = $this->container->make($modelClass);
            return $this->container->make($repositoryClass, ['model' => $model]);
        }

        return $this->container->make($repositoryClass);
    }

    /**
     * Get the container instance.
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
