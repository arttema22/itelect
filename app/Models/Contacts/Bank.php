<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id'
    ];

    /**
     * Получить компанию, которой принадлежит банковский реквизит.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
