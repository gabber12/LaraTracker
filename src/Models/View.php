<?php

namespace LaraTracker\Links\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'link_views';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function languageFancy()
    {
        $countries = json_decode(file_get_contents(__DIR__.'/../countries.json'), true);
        foreach ($countries as $country) {
            if ($country['code'] == $this->language) {
                return explode(' ', str_replace(';', '', $country['name']))[0];
            }
        }

        return $this->language;
    }
}
