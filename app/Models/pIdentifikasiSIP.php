<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pIdentifikasiSIP extends Model
{
    use HasFactory;
    protected $table = 'p_identifikasi_sip';
    protected $guardede = [];

    public function identifikasi() : BelongsTo {
        return $this->belongsTo(Identifikasi::class, 'identifikasi_id', 'id');
    }

    public function sip() : BelongsTo {
        return $this->belongsTo(mSIP::class, 'm_sip_id', 'id');
    }
}
