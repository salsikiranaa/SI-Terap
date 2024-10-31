<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mMetode extends Model
{
    use HasFactory;
    protected $table = 'm_metode';
    protected $guarded = [];

    public function identifikasi() : HasMany {
        return $this->hasMany(Identifikasi::class, 'metode_id', 'id');
    }

    public function diseminasi() : HasMany {
        return $this->hasMany(Diseminasi::class, 'metode_id', 'id');
    }
}
