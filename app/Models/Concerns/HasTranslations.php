<?php

namespace App\Models\Concerns;

/**
 * Bengali lives in a sibling column: `name` / `name_bn`.
 *
 * Falling back to English when the Bengali is blank is the whole point —
 * the client can translate the site gradually instead of all at once, and a
 * half-translated record never renders as an empty heading.
 */
trait HasTranslations
{
    public function t(string $field): ?string
    {
        if (app()->getLocale() === 'bn') {
            $bengali = $this->{$field.'_bn'} ?? null;

            if (filled($bengali)) {
                return $bengali;
            }
        }

        return $this->{$field};
    }

    /** True when this record still needs translating — used by the admin. */
    public function needsTranslation(array $fields): bool
    {
        foreach ($fields as $field) {
            if (filled($this->{$field}) && blank($this->{$field.'_bn'} ?? null)) {
                return true;
            }
        }

        return false;
    }
}
