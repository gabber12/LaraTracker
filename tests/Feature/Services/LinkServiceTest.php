<?php

namespace Tests\Feature\Services;

use Tests\Feature\DBTestCase;
use Laratracker\Links\Services\LinkService;

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
        $this->assertNotNull('http://www.google.com', $longUrl, 'Converted Url doesnot match');
    }

    public function testCreateLinkAndIdentifier()
    {
        $this->artisan('migrate', ['--database' => 'testbench']);

        $shortUrl = $this->linkService->getShortUrl('http://www.google.com', ['identifier' => 'emi-link-1234']);
        $this->assertEquals(count($this->linkService->getLinkByIdentifier('emi-link-1234')), 1, 'Could not fetch url by identifier');
    }
}
