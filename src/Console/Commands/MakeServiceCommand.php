<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Exception;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name : The name of the service class}';
    protected $description = 'Create a new service class';

    protected Filesystem $files;

    protected const string SERVICE_DIR = 'app/Services';
    protected const string SERVICE_STUB = __DIR__ . '/../../Stubs/service.stub';

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $serviceName = $this->getServiceName();
            $servicePath = $this->getServicePath($serviceName);

            $this->ensureDirectoryExists(dirname($servicePath));
            $this->createServiceFile($serviceName, $servicePath);

            $this->info("Service {$serviceName} created successfully at {$servicePath}");
            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Get the service name, ensuring it's properly formatted.
     *
     * @return string
     */
    protected function getServiceName(): string
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the full path to the service file.
     *
     * @param string $serviceName
     * @return string
     */
    protected function getServicePath(string $serviceName): string
    {
        $serviceDir = Config::get('servicerepo.target_service_dir', self::SERVICE_DIR);
        return base_path("{$serviceDir}/" . str_replace('\\', '/', $serviceName) . '.php');
    }

    /**
     * Ensure the target directory exists.
     *
     * @param string $directory
     * @return void
     */
    protected function ensureDirectoryExists(string $directory): void
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Create the service file.
     *
     * @param string $serviceName
     * @param string $servicePath
     * @return void
     * @throws Exception
     */
    protected function createServiceFile(string $serviceName, string $servicePath): void
    {
        if ($this->files->exists($servicePath)) {
            throw new Exception("Service {$serviceName} already exists.");
        }

        $stub = $this->getStubContent();
        $content = $this->populateStub($stub, $serviceName);

        $this->files->put($servicePath, $content);
    }

    /**
     * Get the content of the service stub.
     *
     * @return string
     * @throws Exception
     */
    protected function getStubContent(): string
    {
        if (!$this->files->exists(self::SERVICE_STUB)) {
            throw new Exception('Stub file not found at ' . self::SERVICE_STUB);
        }

        return $this->files->get(self::SERVICE_STUB);
    }

    /**
     * Populate the stub with dynamic values.
     *
     * @param string $stub
     * @param string $serviceName
     * @return string
     */
    protected function populateStub(string $stub, string $serviceName): string
    {
        $namespace = $this->getNamespace($serviceName);
        $className = $this->getClassName($serviceName);
        $baseServiceParentClass = Config::get('servicerepo.base_service_parent_class', 'Imamsudarajat04\\LaravelBaseServiceRepo\\BaseService');
        $baseServiceInterface = Config::get('servicerepo.base_service_interface', 'Imamsudarajat04\\LaravelBaseServiceRepo\\Contracts\\InterfaceService\\BaseServiceInterface');
        
        // Generate repository namespace and name
        $repositoryName = $this->getRepositoryName($serviceName);
        $repositoryNamespace = $this->getRepositoryNamespace($serviceName);

        return str_replace(
            [
                '{{ namespace }}', 
                '{{ className }}', 
                '{{ baseServiceParentClass }}',
                '{{ baseServiceInterface }}',
                '{{ repositoryName }}',
                '{{ repositoryNamespace }}'
            ],
            [
                $namespace, 
                $className, 
                $baseServiceParentClass,
                $baseServiceInterface,
                $repositoryName,
                $repositoryNamespace
            ],
            $stub
        );
    }

    /**
     * Get the namespace for the service class.
     *
     * @param string $serviceName
     * @return string
     */
    protected function getNamespace(string $serviceName): string
    {
        $baseNamespace = rtrim(str_replace('/', '\\', Config::get('servicerepo.base_namespace', 'App\\Services')), '\\');
        $subNamespace = str_replace('/', '\\', dirname(str_replace('\\', '/', $serviceName)));

        if ($subNamespace === '.') {
            return $baseNamespace;
        }

        return "{$baseNamespace}\\{$subNamespace}";
    }

    /**
     * Get the class name for the service.
     *
     * @param string $serviceName
     * @return string
     */
    protected function getClassName(string $serviceName): string
    {
        return basename(str_replace('\\', '/', $serviceName));
    }

    /**
     * Get the repository name for the service.
     *
     * @param string $serviceName
     * @return string
     */
    protected function getRepositoryName(string $serviceName): string
    {
        $className = $this->getClassName($serviceName);
        return str_replace('Service', 'Repository', $className);
    }

    /**
     * Get the repository namespace for the service.
     *
     * @param string $serviceName
     * @return string
     */
    protected function getRepositoryNamespace(string $serviceName): string
    {
        $baseNamespace = rtrim(str_replace('/', '\\', Config::get('servicerepo.base_namespace', 'App\\Repositories')), '\\');
        $subNamespace = str_replace('/', '\\', dirname(str_replace('\\', '/', $serviceName)));

        if ($subNamespace === '.') {
            return $baseNamespace;
        }

        return "{$baseNamespace}\\{$subNamespace}";
    }
}