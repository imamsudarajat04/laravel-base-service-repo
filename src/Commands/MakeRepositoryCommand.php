<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository 
                            {name : The name of the repository}
                            {--model= : Create a model for the repository (optional)}
                            {--without-model : Create repository without a model}';

    protected $description = 'Create a new repository for a model with query functionality, optionally creating a model.';

    protected const string REPOSITORY_DIR = 'app/Repositories';
    protected const string MODEL_DIR = 'app/Models';
    protected const string REPOSITORY_STUB = __DIR__ . '/../Stubs/repository.stub';
    protected const string MODEL_STUB = __DIR__ . '/../Stubs/model.stub';

    protected Filesystem $files;

    /**
     * Construction
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $repositoryName = $this->getRepositoryName();
            $repositoryPath = $this->getRepositoryPath($repositoryName);
            $this->createRepository($repositoryName, $repositoryPath);

            if (!$this->option('without-model')) {
                $this->createModel();
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getRepositoryName(): string
    {
        $name = $this->argument('name');
        if (!str_ends_with($name, 'Repository')) {
            $name .= 'Repository';
        }
        return $name;
    }

    /**
     * @param string $repositoryName
     * @return string
     */
    protected function getRepositoryPath(string $repositoryName): string
    {
        $repositoryDir = Config::get('servicerepo.target_repository_dir', self::REPOSITORY_DIR);
        return base_path("{$repositoryDir}/" . str_replace('\\', '/', $repositoryName) . '.php');
    }

    /**
     * @param string $repositoryName
     * @param string $repositoryPath
     * @return void
     * @throws FileNotFoundException
     */
    protected function createRepository(string $repositoryName, string $repositoryPath): void
    {
        $directoryPath = dirname($repositoryPath);
        $this->ensureDirectoryExists($directoryPath);

        if ($this->files->exists($repositoryPath)) {
            $this->warn("Repository {$repositoryName} already exists.");
            return;
        }

        $stub = $this->getStubContent(self::REPOSITORY_STUB);
        $content = $this->populateRepositoryStub($stub, $repositoryName);

        $this->files->put($repositoryPath, $content);
        $this->info("Repository {$repositoryName} created successfully at {$repositoryPath}");
    }

    /**
     * @return void
     * @throws FileNotFoundException
     */
    protected function createModel(): void
    {
        $modelName = $this->option('model') ?: $this->getModelName($this->argument('name'));
        $modelPath = base_path(self::MODEL_DIR . "/{$modelName}.php");

        $this->ensureDirectoryExists(base_path(self::MODEL_DIR));

        if ($this->files->exists($modelPath)) {
            $this->warn("Model {$modelName} already exists.");
            return;
        }

        $stub = $this->getStubContent(self::MODEL_STUB);
        $content = str_replace('{{ className }}', $modelName, $stub);

        $this->files->put($modelPath, $content);
        $this->info("Model {$modelName} created successfully in " . self::MODEL_DIR);
    }

    /**
     * @param string $repositoryName
     * @return string
     */
    protected function getModelName(string $repositoryName): string
    {
        $repositoryName = str_replace('\\', '/', $repositoryName);
        $baseName = basename($repositoryName);
        return str_replace('Repository', '', $baseName);
    }

    /**
     * @param string $path
     * @return string
     * @throws FileNotFoundException
     */
    protected function getStubContent(string $path): string
    {
        if (!$this->files->exists($path)) {
            throw new FileNotFoundException("Stub file not found at {$path}");
        }
        return $this->files->get($path);
    }

    /**
     * @param string $stub
     * @param string $repositoryName
     * @return string
     */
    protected function populateRepositoryStub(string $stub, string $repositoryName): string
    {
        $repositoryNamespace = $this->getNamespace($repositoryName);
        $modelNamespace = Config::get('servicerepo.target_model_namespace', 'App\Models');
        $baseClassNamespace = Config::get('servicerepo.base_repository_parent_class', 'BaseRepository');
        $modelName = $this->getModelName($repositoryName);

        return str_replace(
            ['{{ namespace }}', '{{ modelNamespace }}', '{{ baseRepositoryParentClassNamespace }}', '{{ className }}', '{{ modelName }}'],
            [$repositoryNamespace, $modelNamespace, $baseClassNamespace, basename($repositoryName), $modelName],
            $stub
        );
    }

    /**
     * @param string $repositoryName
     * @return string
     */
    protected function getNamespace(string $repositoryName): string
    {
        $repositoryDir = Config::get('servicerepo.target_repository_namespace', 'App\Repositories');
        $normalizedRepositoryName = str_replace('\\', '/', $repositoryName);
        if (str_contains($normalizedRepositoryName, '/')) {
            $subNamespace = str_replace('/', '\\', dirname($normalizedRepositoryName));
            return rtrim("{$repositoryDir}/{$subNamespace}", '\\');
        }

        return $repositoryDir;
//        $namespaceParts = explode('/', $normalizedRepositoryName);
//        if (count($namespaceParts) === 1) {
//            $subNamespace = '';
//        } else {
//            array_pop($namespaceParts);
//            $subNamespace = implode('\\', $namespaceParts);
//        }
//        return rtrim("{$repositoryDir}\\{$subNamespace}", '\\');
    }

    /**
     * @param string $directory
     * @return void
     */
    protected function ensureDirectoryExists(string $directory): void
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }
}
