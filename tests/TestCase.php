<?php

namespace Bnussbau\LaravelTrmnl\Tests;

use Bnussbau\LaravelTrmnl\LaravelTrmnlServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Bnussbau\\LaravelTrmnl\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelTrmnlServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

//        $migration = include __DIR__.'/../database/migrations/create_trmnl_table.php.stub';
//        $migration->up();
    }
}
