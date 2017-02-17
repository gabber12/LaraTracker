<?php

namespace Tests\Feature\Services;


use Orchestra\Testbench\TestCase;
use Laratracker\Links\Services\LinkService;


class LinkServiceTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        
        $this->linkService = new LinkService('');
    }
    public function testServiceCanBeConstructed()
    {
       
        $this->assertNotNull($this->linkService);
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
     * 
     */
    public function testCreateLinkForMalformedUrl()
    {
        $this->linkService->getShortUrl('', []);
    }

    public function testCreateLinkPersistsLink() 
    {
            $this->artisan('migrate', ['--database' => 'testbench']);

        $shortUrl = $this->linkService->getShortUrl('http://www.google.com', []);
        $longUrl = $this->linkService->getLongUrl($shortUrl);
        $this->assertNotNull('http://www.google.com', $longUrl, "Converted Url doesnot ");
    }
}
=