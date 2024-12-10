<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diseminasi extends Model
{
    use HasFactory;
    protected $table = 'diseminasi';
    protected $guarded = [];

    public function bsip() : BelongsTo {
        return $this->belongsTo(mBSIP::class, 'bsip_id', 'id');
    }

    public function metode() : BelongsTo {
        return $this->belongsTo(mMetode::class, 'metode_id', 'id');
    }

    public function jenis_standard() : BelongsTo {
        return $this->belongsTo(mJenisStandard::class, 'jenis_standard_id', 'id');
    }

    public function kelompok_standard() : BelongsTo {
        return $this->belongsTo(mKelompokStandard::class, 'kelompok_standard_id', 'id');
    }
    
    public function created_by() : BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
    public function updated_by() : BelongsTo {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function sip() : BelongsToMany {
        return $this->belongsToMany(mSIP::class, 'p_diseminasi_sip', 'diseminasi_id', 'sip_id');
    }

    public function sasaran() : BelongsToMany {
        return $this->belongsToMany(mSasaran::class, 'p_diseminasi_sasaran', 'diseminasi_id', 'sasaran_id');
    }
}
