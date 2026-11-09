<?php

namespace App\Support;

use App\Models\Course;
use App\Models\Destination;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

/**
 * Data every page needs. Cached forever and flushed by the model events
 * registered in AppServiceProvider, so an edit in the admin shows up at once
 * without the site querying settings on every request.
 */
class Site
{
    public const CACHE_KEYS = [
        'site.settings',
        'site.nav.courses',
        'site.nav.destinations',
    ];

    public static function settings(): array
    {
        return Cache::rememberForever(
            'site.settings',
            fn () => Setting::pluck('value', 'key')->all(),
        );
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::settings()[$key] ?? $default;
    }

    /** Courses for the Language Courses menu and the footer. */
    public static function navCourses()
    {
        return Cache::rememberForever(
            'site.nav.courses',
            fn () => Course::active()->ordered()->get(['id', 'slug', 'name', 'exam_name']),
        );
    }

    /** Destinations for the Study Abroad menu and the footer. */
    public static function navDestinations()
    {
        return Cache::rememberForever(
            'site.nav.destinations',
            fn () => Destination::active()->ordered()->get(['id', 'slug', 'name', 'flag']),
        );
    }

    /**
     * The page's address on the primary domain, whichever host served it.
     *
     * The site answers on more than one domain. url()->current() reflects the
     * host that was asked, so each domain would declare itself canonical and
     * search engines would treat the two as separate, competing pages. Built
     * from APP_URL instead, every copy of a page points at the same address.
     *
     * Only the canonical and sharing tags use this. Links and form actions
     * stay on the host the visitor is actually on — sending a form across
     * domains would lose the session and fail CSRF.
     */
    public static function canonical(): string
    {
        return rtrim(config('app.url'), '/').request()->getPathInfo();
    }

    public static function flush(): void
    {
        foreach (static::CACHE_KEYS as $key) {
            Cache::forget($key);
        }
    }
}
