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
    protected const string STUB_PATH = __DIR__ . '/../Stubs/repository.stub';
    protected Filesystem $files;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * @return void
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $name = $this->argument('name');

        if (!str_ends_with($name, 'Repository')) {
            $name .= 'Repository';
        }

        $repositoryDir = Config::get('servicerepo.target_repository_dir', 'app/Repositories');
        $repositoryNamespace = "App\\Repositories";
        $modelNamespace = "App\\Models";
        $className = $name;
        $path = base_path("{$repositoryDir}/{$className}.php");

        if (!$this->files->exists(self::STUB_PATH)) {
            $this->error("Stub file not found at " . self::STUB_PATH);
            return;
        }

        if (!$this->files->isDirectory(base_path($repositoryDir))) {
            $this->files->makeDirectory(base_path($repositoryDir), 0755, true);
        }

        $stub = $this->files->get(self::STUB_PATH);
        $stub = str_replace('{{ namespace }}', $repositoryNamespace, $stub);
        $stub = str_replace('{{ modelNamespace }}', $modelNamespace, $stub);
        $stub = str_replace('{{ baseRepositoryParentClassNamespace }}', Config::get('servicerepo.base_repository_parent_class'), $stub);
        $stub = str_replace('{{ className }}', $className, $stub);
        $stub = str_replace('{{ modelName }}', $this->getModelName($name), $stub);

        $this->files->put($path, $stub);
        $this->info("Repository {$className} has been created at {$repositoryDir}");

        if (!$this->option('without-model')) {
            $this->createModel();
        }
    }

    /**
     * @param string $repositoryName
     * @return string
     */
    protected function getModelName(string $repositoryName): string
    {
        return str_replace('Repository', '', $repositoryName);
    }

    /**
     * @return void
     * @throws FileNotFoundException
     */
    protected function createModel(): void
    {
        $modelName = $this->option('model') ?: $this->getModelName($this->argument('name'));
        $modePath = app_path("Models/{$modelName}.php");

        if ($this->files->exists($modePath)) {
            $this->warn("Model {$modelName} already exists.");
            return;
        }

        $stubPath = __DIR__ . '/../Stubs/model.stub';
        if (!$this->files->exists($stubPath)) {
            $this->error("Model stub not found at  {$stubPath}");
            return;
        }

        $modelStub = $this->files->get($stubPath);
        $modelStub = str_replace('{{ className }}', $modelName, $modelStub);

        $this->files->put($modePath, $modelStub);
        $this->info("Model {$modelName} has been created at app/Models!");
    }
}
