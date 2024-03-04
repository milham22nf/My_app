<?php

namespace App\Models;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_name',
        'bio',
        'picture',
        'status',
        'role',
        'alamat',
        'no_telp',
    ];
    protected $table = 'users';

    /**
     * Get all of the Foto for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Foto(): HasMany
    {
        return $this->hasMany(Foto::class, 'id_user', 'id');
    }

    /**
     * Get all of the Komentar for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Komentar(): HasMany
    {
        return $this->hasmany(Komentar::class, 'id_user', 'id');
    }

    /**
     * Get the Like associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Like()
    {
        return $this->hasOne(Like::class, 'id_user', 'id');
    }

    /**
     * Get all of the Album for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Album(): HasMany
    {
        return $this->hasMany(Album::class, 'id_user', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
