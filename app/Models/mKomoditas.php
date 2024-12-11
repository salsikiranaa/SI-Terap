<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mKomoditas extends Model
{
    use HasFactory;
    protected $table = 'm_komoditas';
    protected $guarded = [];

    public function perbenihan() : HasMany {
        return $this->hasMany(Perbenihan::class, 'komoditas_id', 'id');
    }
}
