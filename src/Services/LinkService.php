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

    private function persistLink($url, $shortUrl)
    {
        $data = [
            'url' => $url,
            'shortUrl' => $shortUrl,

        ];
        if (isset($attribures['url_identifier'])) {
            $data['url_identifier'] = $attribures['url_identifier'];
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

        $cleanUrl = $this->getCleanUrl($url);

        if ($link = Link::where('url', $url)->first()) {
            return $link->short_url;
        }

        $shortenedUrl = $this->shorten($cleanUrl);

        $link = $this->persistLink($url, $shortenedUrl, $attributes);

        return $shortenedUrl;
    }
}
