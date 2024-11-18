<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class mProvinsi extends Model
{
    use HasFactory;
    protected $table = 'm_provinsi';
    protected $fillable = ['nama_provinsi', 'latitude', 'longitude', 'jumlah_dokumen'];

    public function bsip() : HasOne {
        return $this->hasOne(mBSIP::class, 'provinsi_id', 'id');
    }

    public function kabupaten() : HasMany {
        return $this->hasMany(mKabupaten::class, 'provinsi_id', 'id');
    }
}
