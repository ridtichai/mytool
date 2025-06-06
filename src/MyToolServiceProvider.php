<?php

namespace ridtichai\ProjectScaffold;

use Illuminate\Support\ServiceProvider;
use YourName\ProjectScaffold\Commands\InitProjectCommand;

class MyToolServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            InitProjectCommand::class,
        ]);
    }
}
