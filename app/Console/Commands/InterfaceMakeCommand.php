<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class InterfaceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Interface class';


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
        return base_path('/stubs/interface.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\interfaces\repositories';

    }
}
