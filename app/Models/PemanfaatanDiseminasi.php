<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemanfaatanDiseminasi extends Model
{
    use HasFactory;
    protected $table = 'pemanfaatan_diseminasi';
    protected $guarded = [];

    public function pemanfaatan_sip() : BelongsTo {
        return $this->belongsTo(PemanfaatanSIP::class, 'pemanfaatan_sip_id', 'id');
    }
}
