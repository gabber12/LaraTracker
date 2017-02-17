<?php

namespace Laratracker\Links\Services;

use Laratracker\Links\Models\Link;

/**
 * This is the link class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class LinkService
{
    public function __construct()
    {
    }

    private function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Returns a canonicalized clean url.
     *
     * @return string
     **/
    private function cleanUrl($url)
    {
        //TODO: Canonicalize Url $this->transformedUrl =
        return $url;
    }

    /**
     * Returns a ShortenLinkBuilder.
     *
     * @param string $url Url to be shortened
     *
     * @return string
     **/
    private function getShortener($url)
    {
        return new ShortLinkBuilder($url);
    }

    private function shorten($url)
    {
        $shortener = $this->getShortener($url);

        return $shortener->shorten($url);
    }

    private function persistLink($url, $shortUrl, $attributes)
    {
        $data = [
            'url' => $url,
            'short_url' => $shortUrl,

        ];
        if (isset($attributes['identifier'])) {
            $data['identifier'] = $attributes['identifier'];
        }

        return Link::create($data);
    }

    /**
     * Returns a shortened url.
     *
     * @return string
     **/
    public function getShortUrl($url, $attributes)
    {
        if (! $this->validateUrl($url)) {
            throw new \InvalidArgumentException("Invalid Url: ($url) supplied");
        }

        $cleanUrl = $this->cleanUrl($url);

        if ($link = Link::where('url', $url)->first()) {
            return $link->short_url;
        }

        $shortenedUrl = $this->shorten($cleanUrl);

        $link = $this->persistLink($url, $shortenedUrl, $attributes);

        return $shortenedUrl;
    }

    /**
     * Returns a shortened url.
     *
     * @return string
     **/
    public function getLongUrl($shortUrl)
    {
        if (! $this->validateUrl($shortUrl)) {
            throw new \InvalidArgumentException("Invalid Url: ($shortUrl) supplied");
        }

        if ($link = Link::where('short_url', $shortUrl)->first()) {
            return $link->url;
        }
    }

    public function getLinksByIdentifier($id)
    {
        return Link::byId($id)->get();
    }
}
