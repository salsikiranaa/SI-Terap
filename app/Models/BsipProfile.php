<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BsipProfile extends Model
{
    protected $table = 'bsip_profile';
    protected $guarded = [];

    public function m_bsip() : BelongsTo
    {
        return $this->belongsTo(mBSIP::class, 'm_bsip_id', 'id');
    }
}