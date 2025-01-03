<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Exception;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name : The name of the service class}';
    protected $description = 'Create a new service class';

    /**
     * @return int
     */
    public function handle()
    {
        try {
            $name = $this->argument('name');
            $path = base_path('app/Services');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $filePath = $path . '/' . $name . '.php';

            if (File::exists($filePath)) {
                $this->error('Service already exists!');
                return Command::FAILURE;
            }

            $stubPath = __DIR__ . '/../Stubs/service.stub';

            if (!File::exists($stubPath)) {
                throw new \Exception('Stub file not found!');
            }

            $stub = File::get($stubPath);

            $content = str_replace('DummyClass', $name, $stub);
            File::put($filePath, $content);

            $this->info("Service {$name} created successfully.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}