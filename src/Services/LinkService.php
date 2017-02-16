<?php

namespace LTracker\Links\Services;

use LTracker\Links\Models\Link;

/**
 * This is the link class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class LinkService
{
    public function __construct($url)
    {
        $this->url = $url;
    }

    
}
