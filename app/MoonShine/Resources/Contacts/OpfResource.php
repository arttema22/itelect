<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Contacts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts\opf;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

class OpfResource extends ModelResource
{
    protected string $model = Opf::class;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public function title(): string
    {
        return __('contacts.opfs');
    }

    public string $column = 'short';

    public function indexFields(): array
    {
        return [
            StackFields::make('short/full')
                ->fields([
                    Text::make('short'),
                    Text::make('full'),
                ])->translatable('contacts'),
        ];
    }

    public function formFields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Text::make('short')->translatable('contacts')->required(),
                    Text::make('full')->translatable('contacts')->required(),
                ])->columnSpan(8),
                Column::make([])->columnSpan(4),
            ]),
        ];
    }

    public function detailFields(): array
    {
        return [
            Text::make('short')->translatable('contacts'),
            Text::make('full')->translatable('contacts'),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'short' => ['required', 'string', 'min:2'],
            'full' => ['required', 'string', 'min:5'],
        ];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: OpfResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }
}
