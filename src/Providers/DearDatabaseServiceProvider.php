<?php

namespace Bonlineza\DearDatabase\Providers;

use Illuminate\Support\ServiceProvider;

class DearDatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'dear-database');
    }
}
