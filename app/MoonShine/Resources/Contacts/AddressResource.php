<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Contacts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts\Address;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\Hidden;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

class AddressResource extends ModelResource
{
    protected string $model = Address::class;

    protected string $title = 'Addresses';

    public string $column = 'address';

    public function indexFields(): array
    {
        return [
            StackFields::make('postcode/address')
                ->fields([
                    Text::make('postcode'),
                    Text::make('address'),
                ])->translatable('contacts'),
        ];
    }

    public function formFields(): array
    {
        return [
            Hidden::make('company_id'),
            Grid::make([
                Column::make([
                    Text::make('postcode')->translatable('contacts')->mask('999999'),
                    Text::make('address')->translatable('contacts')->required(),
                ])->columnSpan(8),
                Column::make([
                    Date::make('created_at')->translatable('contacts')->disabled(),
                    Date::make('updated_at')->translatable('contacts')->disabled(),
                ])->columnSpan(4),
            ]),
        ];
    }

    public function detailFields(): array
    {
        return [
            Text::make('postcode')->translatable('contacts'),
            Text::make('address')->translatable('contacts'),
            Date::make('created_at')->translatable('contacts'),
            Date::make('updated_at')->translatable('contacts'),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'postcode' => ['nullable', 'numeric', 'digits:6'],
            'address' => ['required', 'string', 'min:5'],
        ];
    }
}
