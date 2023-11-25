<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Contacts;

use App\Models\Contacts\Company;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts\Person;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Hidden;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;

class PersonResource extends ModelResource
{
    protected string $model = Person::class; // Модель

    public function title(): string
    {
        return __('contacts.persons');
    }

    protected int $itemsPerPage = 25; // Количество элементов на странице

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public string $column = 'name';

    public function query(): Builder
    {
        return parent::query()
            ->where('user_id', Auth::user()->id);
    }

    public function indexFields(): array
    {
        return [
            StackFields::make('fio')
                ->fields([
                    Text::make('secname')->translatable('contacts'),
                    Text::make('name')->sortable()->translatable('contacts'),
                    Text::make('surname')->translatable('contacts'),
                ])->translatable('contacts'),
            Text::make('position')->translatable('contacts'),
            Phone::make('phone')->translatable('contacts'),
            Email::make('email')->translatable('contacts'),

            BelongsToMany::make(
                'companies',
                'companies',
                resource: new CompanyResource()
            )->translatable('contacts')
                ->inLine(separator: ' ', badge: true),
        ];
    }

    public function formFields(): array
    {
        return [
            Hidden::make('user_id')->fill(Auth::user()->id),
            Grid::make([
                Column::make([
                    Block::make('name', [
                        Flex::make([
                            Text::make('name')->required()->translatable('contacts'),
                            Text::make('surname')->translatable('contacts'),
                            Text::make('secname')->translatable('contacts'),
                        ]),
                    ])->translatable('contacts'),
                    Block::make('data', [
                        Flex::make([
                            Text::make('position')->translatable('contacts'),
                            Phone::make('phone')->translatable('contacts')->mask('+7(999)999-99-99'),
                            Email::make('email')->translatable('contacts'),
                        ]),
                    ])->translatable('contacts'),
                ])->columnSpan(8),
                Column::make([
                    Block::make('companies', [
                        BelongsToMany::make(
                            'companies',
                            'companies',
                            resource: new CompanyResource()
                        )
                            ->valuesQuery(fn (Builder $query) => $query->where('user_id', Auth::user()->id))
                            ->translatable('contacts')
                            ->creatable()
                            ->selectMode()
                            ->nullable(),
                    ])->translatable('contacts'),
                    Block::make('date', [
                        Flex::make([
                            Date::make('created_at')->translatable('contacts')->disabled(),
                            Date::make('updated_at')->translatable('contacts')->disabled(),
                        ]),
                    ])->translatable('contacts'),
                ])->columnSpan(4),
            ]),
        ];
    }

    public function detailFields(): array
    {
        return [
            Text::make('name')->translatable('contacts'),
            Text::make('surname')->translatable('contacts'),
            Text::make('secname')->translatable('contacts'),
            Text::make('position')->translatable('contacts'),
            Phone::make('phone')->translatable('contacts'),
            Email::make('email')->translatable('contacts'),

            BelongsToMany::make(
                'companies',
                'companies',
                resource: new CompanyResource()
            )->translatable('contacts')
                ->inLine(separator: ' ', badge: true),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'surname' => ['nullable', 'string', 'min:2'],
            'secname' => ['nullable', 'string', 'min:2'],
            'position' => ['nullable', 'string', 'min:2'],
            'phone' => ['nullable', 'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/i'],
            'email' => ['nullable', 'email'],
        ];
    }

    public function search(): array
    {
        return ['name', 'surname', 'secname', 'position', 'phone', 'email'];
    }

    public function filters(): array
    {
        return [
            Text::make('Position', 'position'),
        ];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: PersonResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }
}
