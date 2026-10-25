<?php

namespace App\Support;

/**
 * Cache-busted asset URLs.
 *
 * The CSS and JS are hand-written and have no build step, so nothing
 * fingerprints them. Without a version a returning visitor keeps the copy
 * their browser cached — a styling fix ships and nobody who has been to the
 * site before ever sees it.
 *
 * The file's mtime is the version: it changes exactly when the file does,
 * needs no manifest, and survives a deploy that only touches one asset.
 */
class Asset
{
    /** @var array<string, string> */
    private static array $cache = [];

    public static function url(string $path): string
    {
        return self::$cache[$path] ??= self::build($path);
    }

    private static function build(string $path): string
    {
        $url = asset($path);
        $file = public_path($path);

        return is_file($file) ? $url.'?v='.filemtime($file) : $url;
    }
}
