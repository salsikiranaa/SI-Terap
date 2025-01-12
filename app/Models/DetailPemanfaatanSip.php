<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPemanfaatanSip extends Model
{
    use HasFactory;
    protected $table = 'detail_pemanfaatan_sip';
    protected $guarded = [];

    public function pemanfaatan_sip() : BelongsTo {
        return $this->belongsTo(PemanfaatanSIP::class, 'pemanfaatan_sip_id', 'id');
    }

    public function program_pemanfaatan_sip() : HasMany {
        return $this->hasMany(ProgramPemanfaatanSip::class, 'detail_pemanfaatan_sip_id', 'id');
    }
}
