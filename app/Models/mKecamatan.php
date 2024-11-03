<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mKecamatan extends Model
{
    use HasFactory;
    protected $table = 'm_kecamatan';
    protected $guarded = [];

    public function kabupaten() : BelongsTo {
        return $this->belongsTo(mKabupaten::class, 'kabupaten_id', 'id');
    }

    public function penyuluh() : HasMany {
        return $this->hasMany(Penyuluh::class, 'kecamatan_id', 'id');
    }
}
