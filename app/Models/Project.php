<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'partner_name',
        'partner_logo',
        'category',
        'tech_stack',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getPartnerLogoUrlAttribute(): ?string
    {
        if ($this->partner_logo) {
            return asset('storage/' . $this->partner_logo);
        }
        return null;
    }
}
