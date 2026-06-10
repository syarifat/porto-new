<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issued_by',
        'issued_date',
        'image_path',
        'credential_id',
        'credential_url',
    ];

    protected $casts = [
        'issued_date' => 'date',
    ];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
