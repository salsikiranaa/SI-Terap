<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Riset extends Model
{
    use HasFactory;

    protected $table = 'riset';
    protected $guarded = [];

    public function kecamatan() : BelongsTo {
        return $this->belongsTo(mKecamatan::class, 'kecamatan_id', 'id');
    }
};
