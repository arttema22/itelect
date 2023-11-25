<?php

namespace App\Models\Documents;

use App\Models\Contacts\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * Получить тип документа.
     */
    public function doctype()
    {
        return $this->belongsTo(DocType::class);
    }

    /**
     * Получить компанию.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
