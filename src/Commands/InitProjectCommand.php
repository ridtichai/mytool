<?php

namespace ridtichai\ProjectScaffold\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InitProjectCommand extends Command
{
    protected $signature = 'mytool:init';
    protected $description = 'Initialize layout, pages, and routes for new Laravel project.';

    public function handle()
    {
        // สร้าง layout
        $layoutPath = resource_path('views/layouts/app.blade.php');
        if (!File::exists($layoutPath)) {
            File::ensureDirectoryExists(dirname($layoutPath));
            File::copy(__DIR__ . '/../../stubs/layout.blade.php', $layoutPath);
            $this->info('Created: layouts/app.blade.php');
        }

        // สร้าง home page
        $homePath = resource_path('views/home.blade.php');
        if (!File::exists($homePath)) {
            File::copy(__DIR__ . '/../../stubs/home.blade.php', $homePath);
            $this->info('Created: home.blade.php');
        }

        // เพิ่ม route
        $routePath = base_path('routes/web.php');
        $routeStub = file_get_contents(__DIR__ . '/../../stubs/web.php');
        File::append($routePath, "\n\n" . $routeStub);
        $this->info('Updated: web.php');
    }
}
