<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CMS extends Model
{
    use HasFactory;
    protected $table = 'cms';
    protected $guarded = [];

    public function updated_by() : BelongsTo {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
