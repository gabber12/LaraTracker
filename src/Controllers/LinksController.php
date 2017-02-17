<?php

namespace Laratracker\Links\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laratracker\Links\Models\Link;

class LinksController extends Controller
{
    /**
     * Redirects the user to the link.
     *
     * @param  Illuminate\Http\Request $request Request object
     *
     * @return string
     */
    public function redirect(Request $request)
    {
        $url = $request->url(); // Not using fullUrl needs experimentation
        $link = $this->findOrAbort($url);

        $link->addClick();

        return redirect($link->url);
    }

    private function findOrAbort($url)
    {
        if (! $link = Link::where('short_url', $url)->first()) {
            abort(404, 'Unable to find this link');
        }

        return $link;
    }
}
