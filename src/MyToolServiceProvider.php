<?php

namespace ridtichai\ProjectScaffold;

use Illuminate\Support\ServiceProvider;
use ridtichai\ProjectScaffold\Commands\InitProjectCommand;

class MyToolServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            InitProjectCommand::class,
        ]);
    }
}
