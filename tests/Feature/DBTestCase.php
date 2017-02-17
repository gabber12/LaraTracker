<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class DBTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Laratracker\Links\TrackingServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Tracker' => 'Laratracker\Links\Facades\Tracker',
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
