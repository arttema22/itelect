<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Contacts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts\Bank;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\Hidden;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

class BankResource extends ModelResource
{
    protected string $model = Bank::class;

    protected string $title = 'Banks';

    public string $column = 'name';

    public function indexFields(): array
    {
        return [
            StackFields::make('name/bic')
                ->fields([
                    Text::make('name'),
                    Text::make('bic'),
                ])->translatable('contacts'),
            Text::make('ks')->translatable('contacts'),
            Text::make('rs')->translatable('contacts'),
        ];
    }

    public function formFields(): array
    {
        return [
            Hidden::make('company_id'),
            Grid::make([
                Column::make([
                    Text::make('name')->translatable('contacts')->required(),
                    Text::make('bic')->translatable('contacts')->mask('999999999'),
                    Text::make('ks')->translatable('contacts')->mask('99999999999999999999'),
                    Text::make('rs')->translatable('contacts')->mask('99999999999999999999'),

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
            Text::make('name')->translatable('contacts'),
            Text::make('bic')->translatable('contacts'),
            Text::make('ks')->translatable('contacts'),
            Text::make('rs')->translatable('contacts'),
            Date::make('created_at')->translatable('contacts'),
            Date::make('updated_at')->translatable('contacts'),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'bic' => ['nullable', 'numeric', 'digits:9'],
            'ks' => ['nullable', 'numeric', 'digits:20'],
            'rs' => ['nullable', 'numeric', 'digits:20'],
        ];
    }
}
