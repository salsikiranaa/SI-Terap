<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
