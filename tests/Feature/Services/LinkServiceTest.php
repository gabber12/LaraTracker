<?php
namespace Tests\Feature\Services;
use PHPUnit\Framework\TestCase;
use Laratracker\Links\Services\LinkService;
class LinkServiceTest extends TestCase
{
    public function testServiceCanBeConstructed()
    {
        $linkService = new LinkService('');
        $this->assertNotNull($linkService);
    }

    
}