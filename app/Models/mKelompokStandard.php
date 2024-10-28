<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mKelompokStandard extends Model
{
    use HasFactory;
    protected $table = 'm_kelompok_standard';
    protected $guarded = [];

    public function diseminasi() : HasMany {
        return $this->hasMany(Diseminasi::class, 'kelompok_standard_id', 'id');
    }

    public function pendampingan() : HasMany {
        return $this->hasMany(Pendampingan::class, 'kelompok_standard_id', 'id');
    }
}
