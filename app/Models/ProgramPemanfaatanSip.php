<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramPemanfaatanSip extends Model
{
    use HasFactory;
    protected $table = 'program_pemanfaatan_sip';
    protected $guarded = [];

    public function detail_pemanfaatan_sip() : BelongsTo {
        return $this->belongsTo(DetailPemanfaatanSip::class, 'detail_pemanfaatan_sip_id', 'id');
    }
}
