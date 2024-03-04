<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'judul_album',
        'deskripsi_album',
    ];
    protected $table = 'albums';

    /**
     * Get the user that owns the Album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the Foto that owns the Album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class, 'id_album', 'id');
    }

    
}
