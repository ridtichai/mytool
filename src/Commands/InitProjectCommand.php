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
        $this->info("✅ เริ่มต้นติดตั้ง controller , layout และ page");

        // สร้าง layout
        $layoutPath = resource_path('views/layouts/index.blade.php');
          File::ensureDirectoryExists(dirname($layoutPath));
        if (!File::exists($layoutPath)) {
            File::ensureDirectoryExists(dirname($layoutPath));
            File::copy(__DIR__ . '/../stubs/layout.blade.php', $layoutPath);
            $this->info('Created: layouts/index.blade.php');
        }

        // สร้าง home page       
        $homePath = resource_path('views/pages/home/index.blade.php');
         // สร้างโฟลเดอร์หากยังไม่มี
        File::ensureDirectoryExists(dirname($homePath));
        if (!File::exists($homePath)) {
            File::copy(__DIR__ . '/../stubs/home.blade.php', $homePath);
            $this->info('Created: home.blade.php');
        }

        // Copy IndexController
        $controllerPath = app_path('Http/Controllers/IndexController.php');
        if (!File::exists($controllerPath)) {
            File::copy(__DIR__ . '/../Controllers/IndexController.php', $controllerPath);
            $this->info('Created: IndexController.php');
        }


        $controllerPath = app_path('Http/Controllers/AuthController.php');
        if (!File::exists($controllerPath)) {
            File::copy(__DIR__ . '/../Controllers/AuthController.php', $controllerPath);
            $this->info('Created: AuthController.php');
        }

        // เพิ่ม route
        $routePath = base_path('routes/web.php');
        $routeStub = file_get_contents(__DIR__ . '/../stubs/web.php');
        File::append($routePath, "\n\n" . $routeStub);
        $this->info('Updated: web.php');

        $this->info("🎉 ติดตั้งเสร็จแล้ว!");
    }
}
