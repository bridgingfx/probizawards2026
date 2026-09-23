<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'category',
        'website',
        'logo',
        'message',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function logoUrl(): ?string
    {
        return $this->logo ? asset('uploads/media_partners/'.$this->logo) : null;
    }
}
