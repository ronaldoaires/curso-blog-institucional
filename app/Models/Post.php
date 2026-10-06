<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'cover',
        'title',
        'content',
        'is_active',
        'author',
        'views',
        'last_visit_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active'     => 'boolean',
            'views'         => 'integer',
            'last_visit_at' => 'datetime',
        ];
    }

    /**
     * Get the author user of the post.
     *
     * Relationship: Belongs to one User (N:1), nullable.
     * When the user is deleted, user_id is set to null (nullOnDelete).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the post.
     *
     * Relationship: Belongs to one Category (N:1), nullable.
     * When the category is deleted, category_id is set to null (nullOnDelete).
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}