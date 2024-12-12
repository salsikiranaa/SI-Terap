<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class mIP2SIP extends Model
{
    use HasFactory;
    protected $table = 'm_ip2sip';
    protected $guarded = [];

    public function bsip() : BelongsTo {
        return $this->belongsTo(mBSIP::class, 'bsip_id', 'id');
    }

    public function pemanfaatan_sip() : HasOne {
        return $this->hasOne(PemanfaatanSIP::class, 'ip2sip_id', 'id');
    }

    public function aset_tanah() : HasMany {
        return $this->hasMany(AsetTanah::class, 'ip2sip_id', 'id');
    }

    public function aset_gedung() : HasMany {
        return $this->hasMany(AsetGedung::class, 'ip2sip_id', 'id');
    }

    public function aset_lab() : HasMany {
        return $this->hasMany(AsetLab::class, 'ip2sip_id', 'id');
    }

    public function aset_rumah() : HasMany {
        return $this->hasMany(AsetRumah::class, 'ip2sip_id', 'id');
    }

    public function aset_alat() : HasMany {
        return $this->hasMany(AsetAlat::class, 'ip2sip_id', 'id');
    }
}
