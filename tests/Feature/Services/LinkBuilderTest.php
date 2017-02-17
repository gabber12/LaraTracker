<?php

namespace Tests\Feature\Services;

use PHPUnit\Framework\TestCase;
use Laratracker\Links\Services\ShortLinkBuilder;

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

        $this->assertNotNull((string) $linkBuilder->shorten());
    }
}
