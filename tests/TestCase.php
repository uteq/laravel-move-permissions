<?php

namespace Uteq\MovePermissions\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Fortify\FortifyServiceProvider;
use Laravel\Jetstream\JetstreamServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Uteq\Move\MoveServiceProvider;
use Uteq\MovePermissions\PermissionsServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Uteq\\MovePermissions\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            JetstreamServiceProvider::class,
            FortifyServiceProvider::class,
            LivewireServiceProvider::class,
            MoveServiceProvider::class,
            PermissionsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_move_permissions_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
