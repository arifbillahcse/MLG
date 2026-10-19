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

    public static function flush(): void
    {
        foreach (static::CACHE_KEYS as $key) {
            Cache::forget($key);
        }
    }
}
