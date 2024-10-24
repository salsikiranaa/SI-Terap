<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pIdentifikasiSasaran extends Model
{
    use HasFactory;
    protected $table = 'p_identifikasi_sasaran';
    protected $guardede = [];

    public function identifikasi() : BelongsTo {
        return $this->belongsTo(Identifikasi::class, 'identifikasi_id', 'id');
    }

    public function sasaran() : BelongsTo {
        return $this->belongsTo(mSasaran::class, 'm_sasaran_id', 'id');
    }
}
