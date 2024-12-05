<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintsBook extends Model
{
    use HasFactory;
    protected $table = 'complaints_book';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'second_last_name',
        'document_type',
        'document_number',
        'phone_number',
        'address',
        'state',
        'province',
        'district',
        'is_minor',
        'claim_type',
        'receipt_number',
        'purchase_date',
        'guardian_document_type',
        'guardian_document_number',
        'guardian_phone_number',
        'guardian_first_name',
        'guardian_last_name',
        'guardian_second_last_name',
        'claim_details',
        'customer_request',
        'response_date',
        'response'
    ];
}
