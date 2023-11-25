<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTemplate extends Model
{
    use HasFactory;

    /**
     * Получить тип документа.
     */
    public function doctype()
    {
        return $this->belongsTo(DocType::class);
    }
}
