<?php

namespace Laratracker\Links\Models;

use Illuminate\Database\Eloquent\Model;

class LinkClick extends Model
{
    protected $table = 'link_clicks';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
