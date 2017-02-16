<?php

namespace Laratracker\Links\Services;

use LaraTracker\Links\Models\Link;

/**
 * This is the link class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class ShortLinkBuilder
{
    protected $link;
    protected $slug;

    /**
     * Create a new link instance.
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Return a random string.
     * // TODO: May be better approach to 
     * @param int $length
     */
    public function randomString($length = 10)
    {
        return str_random($length);
    }


    public function shorten()
    {
        $result = parse_url($this->url);
        $baseUrl = $result['scheme']."://".$result['host'].":".$result['port'];

        $path = $result['path'];

        return $baseUrl;
    }
   
  
}
