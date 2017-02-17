<?php

namespace Tests\Feature\Controllers;

use Tracker;
use Tests\Feature\DBTestCase;
use Laratracker\Links\Models\Link;

class LinksControllerTest extends DBTestCase
{
    public function testLinkClickShouldRedirect()
    {
        $this->artisan('migrate', ['--database' => 'testbench']);

        $url = Tracker::url('https://www.google.com/search/dsatewrkfdjlkfjdslf');

        // echo json_encode(Link::get()).PHP_EOL;

        $response = $this->call('GET', $url);

        $this->assertEquals(302, $response->getStatusCode(), 'Short Url didnt redirect');
    }

    public function testLinkClickShouldRedirectToOrignalUrl()
    {
        $this->artisan('migrate', ['--database' => 'testbench']);

        $url = Tracker::url('https://www.google.com/search/dsatewrkfdjlkfjdslf');

        // echo json_encode(Link::get()).PHP_EOL;

        $response = $this->call('GET', $url);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(Link::first()->url, $response->headers->get('Location'));
    }
}
