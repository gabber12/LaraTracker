<?php

namespace Tests\Feature\Services;

use Orchestra\Testbench\TestCase;
use Laratracker\Links\Services\LinkService;

class LinkServiceTest extends TestCase
{
    public function testServiceCanBeConstructed()
    {
        $linkService = new LinkService('');
        $this->assertNotNull($linkService);
    }

    protected function getPackageProviders($app)
    {
        return ['Laratracker\Links\LinksServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
        'Tracker' => 'Laratracker\Links\Facades\Links',
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

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testCreateLinkForMalformedUrl()
    {
        \Tracker::url('', []);
    }
}
