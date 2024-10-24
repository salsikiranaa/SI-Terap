<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pDiseminasiSIP extends Model
{
    use HasFactory;
    protected $table = 'p_diseminasi_sip';
    protected $guardede = [];

    public function diseminasi() : BelongsTo {
        return $this->belongsTo(Diseminasi::class, 'diseminasi_id', 'id');
    }

    public function sip() : BelongsTo {
        return $this->belongsTo(mSIP::class, 'm_sip_id', 'id');
    }
}
