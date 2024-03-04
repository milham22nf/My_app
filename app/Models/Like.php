<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_foto',
    ];
    protected $table = 'likes';

    /**
     * Get the User that owns the like
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the Foto that owns the like
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class, 'id_foto', 'id');
    }
}
