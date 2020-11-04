<?php

namespace Uteq\MovePermissions;

use Illuminate\Support\ServiceProvider;
use Uteq\MovePermissions\Commands\PermissionsCommand;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/move-permissions.php' => config_path('move-permissions.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/move-permissions'),
            ], 'views');

            $this->publishes([
                __DIR__ . '/../database/seeders/RolesAndPermissionsSeeder.php.stub' => database_path('seeders/RolesAndPermissionsSeeder'),
            ], 'seeders');

            $migrationFileName = 'create_move_permissions_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                PermissionsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'move');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/move-permissions.php', 'move-permissions');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
