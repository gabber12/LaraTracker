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
        $parsed_url = parse_url($this->url);
        
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
        $pass     = ($user || $pass) ? "$pass@" : ''; 

        $path = isset($parsed_url['path']) ? ':' . $parsed_url['path']  : '';

        return "$scheme$user$pass$host$port/".$this->randomString();
    }
   
  
}
