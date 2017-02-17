<?php

namespace Tests\Feature\Services;

use PHPUnit\Framework\TestCase;
use Laratracker\Links\Services\LinkBuilder;

class LinkBuilderTest extends TestCase
{
    public function testBuilderCanBeConstructed()
    {
        $linkBuilder = new LinkBuilder('');
        $this->assertNotNull($linkBuilder);
    }

    public function testBuilderCanShortenUrl()
    {
        $linkBuilder = new LinkBuilder('https://www.example.com');

        $this->assertNotNull((string) $linkBuilder->shorten());
    }
}
