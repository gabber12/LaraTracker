<?php

namespace Tests\Feature\Services;

use PHPUnit\Framework\TestCase;
use LaraTracker\Links\Services\ShortLinkBuilder;
class LinkBuilderTest extends TestCase
{
    public function testBuilderCanBeConstructed()
    {
        $linkBuilder = new ShortLinkBuilder('');
        $this->assertNotNull($linkBuilder);
    }

    public function testBuilderCanShortenUrl()
    {
        $linkBuilder = new ShortLinkBuilder('https://www.example.com');
        $this->assertEquals((string)$linkBuilder->build());
    }

    
}