<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * Generate a unique slug: title, title-1, title-2...
     *
     * When a persisted $record is given and its title was not changed,
     * the current slug is returned untouched. Otherwise the record itself
     * is ignored in the uniqueness check.
     *
     * @param  class-string<Model>  $modelClass
     */
    public static function unique(
        string $title,
        string $modelClass,
        ?Model $record = null,
        string $titleColumn = 'name',
        string $slugColumn = 'slug',
    ): string {
        $isEditing = $record?->exists === true;

        // Skip regeneration on edit when the title has not changed.
        if (
            $isEditing
            && filled($record->getOriginal($slugColumn))
            && trim((string) $record->getOriginal($titleColumn)) === trim($title)
        ) {
            return $record->getOriginal($slugColumn);
        }

        $base = Str::slug($title) ?: 'item';

        // Fetch every slug that could collide in a single query.
        $existing = $modelClass::query()
            ->when($isEditing, fn(Builder $query) => $query->whereKeyNot($record->getKey()))
            ->where(function (Builder $query) use ($slugColumn, $base): void {
                $query->where($slugColumn, $base)
                    ->orWhere($slugColumn, 'like', $base . '-%');
            })
            ->pluck($slugColumn)
            ->all();

        if (! in_array($base, $existing, true)) {
            return $base;
        }

        $suffix = 1;

        while (in_array("{$base}-{$suffix}", $existing, true)) {
            $suffix++;
        }

        return "{$base}-{$suffix}";
    }
}
