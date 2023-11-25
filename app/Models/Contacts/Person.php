<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'persons';

    use HasFactory;

    /**
     * Компании, принадлежащие персоне.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    protected $fillable = [
        'position'
    ];

    /**
     * Аксессор
     * Показывает номер телефона в нужном формате.
     *
     * @param  string  $value
     * @return string
     */
    public function getPhoneAttribute($value)
    {
        return '+' . substr($value, 0, 1) .
            '(' . substr($value, 1, 3) . ')'
            . substr($value, 4, 3) . '-' . substr($value, 7, 2) . '-' . substr($value, 9, 2);
    }

    /**
     * Мутатор
     * Записывает в базу только цифры из номера телефона.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $value);
    }
}
