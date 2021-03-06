<?php

namespace LaravelEnso\Cli;

use LaravelEnso\Cli\app\Commands\Cli;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(Cli::class);

        $this->loadDependencies()
            ->publishDependencies();
    }

    private function loadDependencies()
    {
        $this->mergeConfigFrom(__DIR__.'/config/model.php', 'enso.structures.model');

        $this->mergeConfigFrom(__DIR__.'/config/menu.php', 'enso.structures.menu');

        $this->mergeConfigFrom(__DIR__.'/config/permissionGroup.php', 'enso.structures.permissionGroup');

        $this->mergeConfigFrom(__DIR__.'/config/permissions.php', 'enso.structures.permissions');

        $this->mergeConfigFrom(__DIR__.'/config/files.php', 'enso.structures.files');

        return $this;
    }

    private function publishDependencies()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso/structures'),
        ], 'cli-config');

        $this->publishes([
            __DIR__.'/config' => config_path('enso/structures'),
        ], 'enso-config');
    }
}
