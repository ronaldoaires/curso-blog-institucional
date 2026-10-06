<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'zip_code',
        'state',
        'city',
        'street',
        'number',
        'complement',
        'neighborhood',
        'is_active',
        'is_primary',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'is_primary' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the address.
     *
     * Relationship: Belongs to one User (N:1).
     * Cascade delete is handled at the database level.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}