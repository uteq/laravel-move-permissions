<?php

namespace Uteq\MovePermissions;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Uteq\Move\Facades\Move;
use Uteq\MovePermissions\Commands\PermissionsCommand;
use Uteq\MovePermissions\Policies\ResourcePolicy;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootPublishers();
            $this->bootCommands();
        }

        $this->bootViews();
        $this->bootPolicies();
    }

    private function bootPublishers(): void
    {
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/move-permissions'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../database/seeders/RolesAndPermissionsSeeder.php.stub' => database_path('seeders/RolesAndPermissionsSeeder.php'),
        ], 'seeders');

        $migrationFileName = 'create_move_permissions_table.php';
        if (! $this->migrationFileExists($migrationFileName)) {
            $this->publishes([
                __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
            ], 'migrations');
        }
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

    public function bootCommands(): void
    {
        $this->commands([
            PermissionsCommand::class,
        ]);
    }

    public function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'move');
    }

    public function bootPolicies(): void
    {
        collect(Move::all())
            ->filter(fn ($resource) => ! Gate::getPolicyFor($resource::$model))
            ->each(function ($resource) {
                Gate::policy($resource::$model, ResourcePolicy::class);
            });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permissions.php', 'move-permissions');
    }
}
