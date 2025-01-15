<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penyuluh extends Model
{
    use HasFactory;
    protected $table = 'penyuluh';
    protected $guarded = [];

    public function kecamatan() : BelongsTo {
        return $this->belongsTo(mKecamatan::class, 'kecamatan_id', 'id');
    }

    public function fungsional() : BelongsTo {
        return $this->belongsTo(mFungsional::class, 'fungsional_id', 'id');
    }
}
