<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perbenihan extends Model
{
    use HasFactory;
    protected $table = 'perbenihan';
    protected $guarded = [];

    public function kabupaten() : BelongsTo {
        return $this->belongsTo(mKabupaten::class, 'kabupaten_id', 'id');
    }

    public function komoditas() : BelongsTo {
        return $this->belongsTo(mKomoditas::class, 'komoditas_id', 'id');
    }

    public function kelas_benih() : BelongsTo {
        return $this->belongsTo(mKelasBenih::class, 'kelas_benih_id', 'id');
    }
}
