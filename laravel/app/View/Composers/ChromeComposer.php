<?php

namespace App\View\Composers;

use App\Support\Site;
use Illuminate\View\View;

/**
 * Binds the topbar, header and footer to the settings table and the
 * course / destination lists, so the menus build themselves.
 */
class ChromeComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'settings' => Site::settings(),
            'navCourses' => Site::navCourses(),
            'navDestinations' => Site::navDestinations(),
        ]);
    }
}
