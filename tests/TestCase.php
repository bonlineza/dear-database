<?php

namespace Bonlineza\DearDatabase\Tests;

use Bonlineza\DearDatabase\Providers\DearDatabaseServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [
            DearDatabaseServiceProvider::class,
        ];
    }
}
