<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use HasFactory;

    protected $table = 'nominations';

    protected $fillable = [
        'reference_id',
        'edition',
        'nomination_type',
        'company',
        'nominee_name',
        'contact',
        'jobtitle',
        'email',
        'confirm_email',
        'phone',
        'country',
        'emirate',
        'uae_activity',
        'branch_location',
        'website',
        'supporting_evidence_path',
        'description',
        'statement',
        'category',
        'subcategory',
        'consent1',
        'consent2',
        'whatsapp_permission',
        'marketing_consent',
        'nomination_state',
        'commercial_state',
        'result_state',
    ];

    protected $casts = [
        'consent1' => 'boolean',
        'consent2' => 'boolean',
        'whatsapp_permission' => 'boolean',
        'marketing_consent' => 'boolean',
    ];
}


