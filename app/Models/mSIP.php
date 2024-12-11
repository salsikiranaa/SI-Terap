<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mSIP extends Model
{
    use HasFactory;
    protected $table = 'm_sip';
    protected $guarded = [];

    public function identifikasi() : BelongsToMany {
        return $this->belongsToMany(Identifikasi::class, 'p_identifikasi_sip', 'sip_id', 'identifikasi_id');
    }

    public function diseminasi() : BelongsToMany {
        return $this->belongsToMany(Diseminasi::class, 'p_diseminasi_sip', 'sip_id', 'diseminasi_id');
    }

    public function riset() : HasMany {
        return $this->hasMany(Riset::class, 'sip_id', 'id');
    }
}
