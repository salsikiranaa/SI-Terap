<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pDiseminasiSasaran extends Model
{
    use HasFactory;
    protected $table = 'p_diseminasi_sasaran';
    protected $guardede = [];

    public function diseminasi() : BelongsTo {
        return $this->belongsTo(Diseminasi::class, 'diseminasi_id', 'id');
    }

    public function sasaran() : BelongsTo {
        return $this->belongsTo(mSasaran::class, 'm_sasaran_id', 'id');
    }
}
