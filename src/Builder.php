<?php

namespace Laratracker\Links;

use Request;
use Laratracker\Links\Builder\Link;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Facade;

class Builder
{
    /**
     * Return a new link instance from a url.
     *  
     * @param string $url        Fully qualified url
     * @param array  $attributes ['shorten' => true, 'utm'=>[utm_parameters]]
     *
     * @return string 
     */
    public static function url($url, $attributes=[])
    {
        $linkService = new LinkService($url);
        return $linkService->getShortUrl($attributes);
    }

    /**
     * Return a new link instance from a route name.
     *
     * @param string $url
     */
    public static function route($name, $attributes)
    {
        return new Link(route($name), $attributes);
    }

    // /**
    //  * Create a new link from the current page url.
    //  *
    //  * @param string $url
    //  */
    // public static function track($jquery = false)
    // {
    //     $link = new Link(Request::url());

    //     return $link->ajax($jquery);
    // }
}
