<?php

namespace Laratracker\Links\Services;

use LaraTracker\Links\Models\Link;

class LinkBuilder
{
    protected $link;
    protected $slug;

    /**
     * Create a new link instance.
     *
     * @param string $url Url to be transformed
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Return a random string.
     *
     * @param int $length Length of random string to be generated
     *
     * @return string
     */
    public function randomString($length = 10)
    {
        return str_random($length);
    }

    /**
     * Build the shrotened url.
     *
     * @return string
     */
    public function shorten()
    {
        $parsed_url = parse_url($this->url);

        $scheme = isset($parsed_url['scheme']) ? $parsed_url['scheme'].'://' : '';
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port = isset($parsed_url['port']) ? ':'.$parsed_url['port'] : '';
        $user = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass = isset($parsed_url['pass']) ? ':'.$parsed_url['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';

        $path = isset($parsed_url['path']) ? ':'.$parsed_url['path'] : '';
        //TODO: pick from config
        return "$scheme$user$pass$host$port/links/".$this->randomString();
    }
}
