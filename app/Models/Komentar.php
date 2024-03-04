<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class komentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'isi_komentar',
        'id_user',
        'id_foto',
    ];
    protected $table = 'komentars';

    /**
     * Get the User that owns the komentar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the Foto that owns the komentar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class, 'id_foto', 'id');
    }
}
