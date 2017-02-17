<?php

namespace Laratracker\Links\Models;

use Sinergi\BrowserDetector\Os;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Language;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'short_url', 'identifier',
    ];

    /**
     * Returns the shortered link.
     *
     * @return string
     */
    public function shortered()
    {
        return route('links::redirect', ['short_url' => $this->short_url]);
    }

    /**
     * Returns the link views.
     */
    public function views()
    {
        return $this->hasMany('LaraTracker\Links\Models\LinkClick');
    }

    /**
     * Returns the link unique views.
     *
     * @return int
     */
    public function uniqueViews()
    {
        return $this->views->unique('ip');
    }

    /**
     * Returns the link total views number.
     *
     * @return int
     */
    public function totalViews()
    {
        return $this->views->count();
    }

    /**
     * Returns the link total unique views number.
     *
     * @return int
     */
    public function totalUniqueViews()
    {
        return $this->uniqueViews()->count();
    }

    /**
     * Adds a new view to the link.
     *
     * @return void
     */
    public function addClick()
    {
        $browser = new Browser();
        $os = new Os();
        $device = new Device();
        $language = new Language();

        $view = LinkClick::create(
            [
                'link_id'           => $this->id,
                'language'          => $language->getLanguage(),
                'browser'           => $browser->getName(),
                'browser_version'   => $browser->getVersion(),
                'os'                => $os->getName(),
                'device'            => $device->getName(),
                'os_version'        => $os->getVersion(),
                'ip'                => $this->getIP(),
            ]
        );
    }

    public function scopeById($query, $id)
    {
        return $query->where('identifier', $id);
    }

    /**
     * Gets the real client IP.
     *
     * @return string
     */
    public function getIP()
    {
        return "";

        if (! empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {   //check ip from cloudflare
          $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (! empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
