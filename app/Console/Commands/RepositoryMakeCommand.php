<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository class';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return parent::handle();
    }

    protected function getStub()
    {
        return base_path('/stubs/repository.stub');
    }
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';

    }
}
