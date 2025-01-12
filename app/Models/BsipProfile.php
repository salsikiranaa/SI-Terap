<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsipProfile extends Model
{
    protected $table = 'bsip_profile';

    public function mbsip()
    {
        return $this->belongsTo(Mbsip::class, 'm_bsip_id');
    }
}