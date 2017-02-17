<?php
namespace Tests\Feature\Services;

use Laratracker\Links\Services\LinkService;
use Tests\Feature\DBTestCase;

class LinkServiceTest extends DBTestCase
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
        $this->assertNotNull('http://www.google.com', $longUrl, "Converted Url doesnot match");
    }
}