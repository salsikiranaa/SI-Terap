<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class mKabupaten extends Model
{
    use HasFactory;
    protected $table = 'm_kabupaten';
    protected $guarded = [];

    public function provinsi() : BelongsTo {
        return $this->belongsTo(mProvinsi::class, 'provinsi_id', 'id');
    }

    public function kecamatan() : BelongsTo {
        return $this->belongsTo(mKecamatan::class, 'kecamatan_id', 'id');
    }
}
