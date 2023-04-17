<?php

namespace Bonlineza\DearDatabase\Traits;

use Carbon\Carbon;
use Generator;
use Illuminate\Support\Str;

trait PublishesMigrations
{
    /**
     * Searches migrations and publishes them as assets.
     *
     * @param string $directory
     *
     * @return void
     */
    protected function registerMigrations(string $directory): void
    {
        if ($this->app->runningInConsole()) {
            $generator = function (string $directory): Generator {
                foreach ($this->app->make('files')->allFiles($directory) as $file) {
                    $order = (int) Str::before($file->getFilename(), '_');
                    yield $file->getPathname() => $this->app->databasePath(
                        'migrations/' . Carbon::now()->addSeconds($order)->format('Y_m_d_His') . '_' . Str::after($file->getFilename(), '_')
                    );
                }
            };

            $this->publishes(iterator_to_array($generator($directory)), 'migrations');
        }
    }
}
