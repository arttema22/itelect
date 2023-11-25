<?php

namespace App\Models\Contacts;

use App\Models\Contacts\opf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'opf_id'
    ];

    /**
     * Получить опф компании.
     */
    public function opf()
    {
        return $this->belongsTo(opf::class);
    }

    /**
     * Персоны, принадлежащие компании.
     */
    public function persons()
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Получить адреса компании.
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Получить банковские реквизиты компании.
     */
    public function bank()
    {
        return $this->hasMany(Bank::class);
    }

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
