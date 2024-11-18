<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mBSIP extends Model
{
    use HasFactory;
    protected $table = 'm_bsip';
    protected $guarded = [];

    public function provinsi() : BelongsTo {
        return $this->belongsTo(mProvinsi::class, 'provinsi_id', 'id');
    }

    public function identifikasi() : HasMany {
        return $this->hasMany(Identifikasi::class, 'bsip_id', 'id');
    }

    public function diseminasi() : HasMany {
        return $this->hasMany(Diseminasi::class, 'bsip_id', 'id');
    }

    public function pendampingan() : HasMany {
        return $this->hasMany(Pendampingan::class, 'bsip_id', 'id');
    }

    public function ip2sip() : HasMany {
        return $this->hasMany(mIP2SIP::class, 'bsip_id', 'id');
    }
}
