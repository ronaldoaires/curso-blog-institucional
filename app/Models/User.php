<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_active',
        'avatar',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'is_admin'          => 'boolean',
            'is_active'         => 'boolean',
            'password'          => 'hashed',
        ];
    }

    /**
     * Get all addresses belonging to the user.
     *
     * Relationship: One User has many UserAddress (1:N).
     * When the user is deleted, all addresses are deleted (cascade).
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * Get only the primary address of the user.
     *
     * Relationship: One User has one primary UserAddress (1:1 filtered).
     */
    public function primaryAddress(): HasMany
    {
        return $this->hasMany(UserAddress::class)->where('is_primary', true);
    }

    /**
     * Get all posts authored by the user.
     *
     * Relationship: One User has many Post (1:N).
     * When the user is deleted, posts.user_id is set to null (nullOnDelete).
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    /**
     * Determine if the user can access the Filament admin panel.
     *
     * @param Panel $panel
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'moderador']);
    }
}
