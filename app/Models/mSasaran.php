<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class mSasaran extends Model
{
    use HasFactory;
    protected $table = 'm_sasaran';
    protected $guarded = [];

    public function identifikasi() : BelongsToMany {
        return $this->belongsToMany(Identifikasi::class, 'p_identifikasi_sasaran', 'sasaran_id', 'identifikasi_id');
    }

    public function diseminasi() : BelongsToMany {
        return $this->belongsToMany(Diseminasi::class, 'p_diseminasi_sasaran', 'sasaran_id', 'diseminasi_id');
    }
}
