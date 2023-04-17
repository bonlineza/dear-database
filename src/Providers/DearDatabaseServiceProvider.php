<?php

namespace Bonlineza\DearDatabase\Providers;

use Bonlineza\DearDatabase\Traits\PublishesMigrations;
use Illuminate\Support\ServiceProvider;

class DearDatabaseServiceProvider extends ServiceProvider
{
    use PublishesMigrations;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('dear-database.php')
        ]);
        $this->registerMigrations(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'dear-database');
    }
}
