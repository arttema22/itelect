<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'postcode',
        'address',
    ];

    /**
     * Получить компанию, которой принадлежит адрес.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
