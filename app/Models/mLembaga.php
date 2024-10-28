<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mLembaga extends Model
{
    use HasFactory;
    protected $table = 'm_lembaga';
    protected $guarded = [];

    public function pendampingan() : HasMany {
        return $this->hasMany(Pendampingan::class, 'lembaga_id', 'id');
    }
}
