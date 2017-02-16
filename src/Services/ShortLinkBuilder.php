<?php

namespace LaraTracker\Links\Services;

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
    public function __construct($fullUrl)
    {
        $this->fullUrl = $fullUrl;
        $this->persisted = false;
        $this->slug = null;
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

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    private function getSlug($slug) {
        return $this->slug;
    }

    private function persistLink($linkAttributes) {
        if($this->persisted)
            return $this->link;
        
        $this->link = Link::firstOrCreate($linkAttributes);
        return $this->link;
    }

    /**
     * Returns the link.
     */
    public function build()
    {
        $link = $this->persistLink([
            'url'   => $this->fullUrl,
            'slug'  => $this->slug,
        ]);
        return $link->shortered();
    }

    // /**
    //  * Returns the javascript code to send a and ajax request to the short url.
    //  */
    // public function ajax($jquery = false)
    // {
    //     $url = $this->link->shortered();

    //     $code = $jquery ? "<script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>" : '';

    //     $code .= '<script>';
    //     $code .= "$.get('$url');";
    //     $code .= '</script>';

    //     return $code;
    // }
}
