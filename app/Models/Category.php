<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\SlugHelper;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'parent_id',
        'is_active',
        'views',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'views'     => 'integer',
        ];
    }

    /**
     * Get the parent category (self-referencing).
     *
     * Relationship: Belongs to one parent Category (N:1).
     * When the parent is deleted, parent_id is set to null (nullOnDelete).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories (subcategories).
     *
     * Relationship: One Category has many child Categories (1:N).
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all posts belonging to the category.
     *
     * Relationship: One Category has many Post (1:N).
     * When the category is deleted, posts.category_id is set to null (nullOnDelete).
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Boot the model and register its events.
     */
    protected static function booted(): void
    {
        static::saving(function (Category $category): void {
            // Keep the current slug when editing and the name was not changed.
            if ($category->exists && ! $category->isDirty('name') && filled($category->slug)) {
                return;
            }

            $category->slug = SlugHelper::unique($category->name, static::class, $category);
        });
    }
}
