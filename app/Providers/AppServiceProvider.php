<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Destination;
use App\Models\Setting;
use App\Support\Site;
use App\View\Composers\ChromeComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // The site has no Tailwind, so the default paginator markup would be
        // unstyled. Use the view that matches the project's .pagination CSS.
        Paginator::defaultView('vendor.pagination.default');
        Paginator::defaultSimpleView('vendor.pagination.default');

        View::composer(
            ['partials.topbar', 'partials.header', 'partials.footer'],
            ChromeComposer::class,
        );

        // Editing any of these in the admin should show on the site immediately.
        foreach ([Setting::class, Course::class, Destination::class] as $model) {
            $model::saved(fn () => Site::flush());
            $model::deleted(fn () => Site::flush());
        }
    }
}
