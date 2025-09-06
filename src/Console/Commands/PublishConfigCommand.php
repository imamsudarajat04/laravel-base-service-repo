<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servicerepo:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Service Repository configuration file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $configPath = __DIR__ . '/../Config/servicerepo.php';
        $targetPath = config_path('servicerepo.php');

        if (File::exists($targetPath)) {
            if ($this->confirm('Configuration file already exists. Do you want to overwrite it?')) {
                File::copy($configPath, $targetPath);
                $this->info('Configuration file published successfully!');
            } else {
                $this->info('Configuration file publishing cancelled.');
            }
        } else {
            File::copy($configPath, $targetPath);
            $this->info('Configuration file published successfully!');
        }

        return 0;
    }
}
