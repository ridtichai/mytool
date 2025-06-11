php artisan mytool:init

    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Libs/functions.php"   <---- Add
        ]
    }

---

composer dump-autoload
