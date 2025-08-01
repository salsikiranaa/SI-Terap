<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PemanfaatanSipDokumentasi extends Model
{
    use HasFactory;
    
    protected $table = 'pemanfaatan_sip_dokumentasi';
    
    protected $fillable = [
        'pemanfaatan_sip_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pemanfaatanSip(): BelongsTo
    {
        return $this->belongsTo(PemanfaatanSIP::class, 'pemanfaatan_sip_id', 'id');
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function getIsImageAttribute(): bool
    {
        return str_starts_with($this->file_type, 'image/');
    }

    public function scopeImages($query)
    {
        return $query->where('file_type', 'like', 'image/%');
    }
}