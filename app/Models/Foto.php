<?php

namespace App\Models;

use App\Models\Album;
use App\Models\Komentar;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'judulfoto',
        'deskripsifoto',
        'url',
        'id_user',
        'id_album',
    ];
    protected $table = 'fotos';

    /**
     * Get the user that owns the Foto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
    /**
     * Get all of the Komentar for the Foto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'id_foto', 'id');
    }

    /**
     * Get all of the Like for the Foto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Like(): HasMany
    {
        return $this->hasMany(Like::class, 'id_foto', 'id');
    }

    /**
     * Get all of the Album for the Foto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Album(): HasMany
    {
        return $this->hasMany(Album::class, 'id_album', 'id');
    }
}
