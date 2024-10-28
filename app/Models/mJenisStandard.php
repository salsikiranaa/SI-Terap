<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mJenisStandard extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_standard';
    protected $guarded = [];

    public function diseminasi() : HasMany {
        return $this->hasMany(Diseminasi::class, 'jenis_standard_id', 'id');
    }

    public function pendampingan() : HasMany {
        return $this->hasMany(Pendampingan::class, 'jenis_standard_id', 'id');
    }
}
