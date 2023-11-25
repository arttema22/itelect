<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Contacts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts\Company;
use App\MoonShine\Contacts\CompanyFormPage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Textarea;
use MoonShine\Pages\Crud\DetailPage;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Pages\Crud\IndexPage;

class CompanyResource extends ModelResource
{
    protected string $model = Company::class;

    public function title(): string
    {
        return __('contacts.companies');
    }

    public string $column = 'name_short';

    public function query(): Builder
    {
        return parent::query()
            ->where('user_id', Auth::user()->id);
    }

    protected function pages(): array
    {
        return [
            IndexPage::make($this->title()),
            CompanyFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            DetailPage::make(__('moonshine::ui.show')),
        ];
    }

    public function indexFields(): array
    {
        return [
            StackFields::make('opf/name')
                ->fields([
                    BelongsTo::make(
                        'opf',
                        'opf',
                        resource: new OpfResource()
                    ),
                    Text::make('name_full'),
                ])->translatable('contacts'),
            Text::make('inn')->translatable('contacts'),
            BelongsToMany::make(
                'persons',
                'persons',
                fn ($item) => "$item->name $item->surname $item->secname",
                resource: new PersonResource()
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
                            BelongsTo::make(
                                'opf',
                                'opf',
                                resource: new OpfResource()
                            )->translatable('contacts'),
                            Text::make('name_full')->translatable('contacts')->required(),
                            Text::make('name_short')->translatable('contacts')->required(),
                        ]),
                    ])->translatable('contacts'),
                    Block::make('data', [
                        Flex::make([
                            Text::make('inn')->translatable('contacts')
                                ->mask('999999999999')
                                ->link('https://www.consultant.ru/document/cons_doc_LAW_134082/ba63b6094fda377ca2790734bae67b97b009f66f/', 'что это?', blank: true)
                                ->copy(),
                            Text::make('ogrnip')->translatable('contacts')
                                ->mask('999999999999999')
                                ->link('https://www.consultant.ru/document/cons_doc_LAW_59699/b5d8b0ad5f78813c139367cd26bba8069f1b08aa/', 'что это?', blank: true)
                                ->showWhen('opf_id', 2)
                                ->copy(),
                            Text::make('ogrn')->translatable('contacts')
                                ->mask('9999999999999')
                                ->link('https://www.consultant.ru/document/cons_doc_LAW_59126/4af9b8975ea2469c6f55017240b02363c93ab52c/', 'что это?', blank: true)
                                ->showWhen('opf_id', '!=', 2)
                                ->copy(),
                            Text::make('okpo')->translatable('contacts')
                                ->mask('99999999999999')
                                ->link('https://www.consultant.ru/document/cons_doc_LAW_133360/0cfa174e25d5a7e2e3deff35c166504a0c79421f/', 'что это?', blank: true)
                                ->copy(),
                            Text::make('okato')->translatable('contacts')
                                ->mask('99999999999')
                                ->link('https://classifikators.ru/okato', 'что это?', blank: true)
                                ->copy(),
                            Text::make('oktmo')->translatable('contacts')
                                ->mask('99999999999')
                                ->link('https://classifikators.ru/oktmo', 'что это?', blank: true)
                                ->copy(),
                        ]),
                        Flex::make([
                            Text::make('okogu')->translatable('contacts')->mask('99999999999')
                                ->mask('9999999')
                                ->link('https://classifikators.ru/okogu', 'что это?', blank: true)
                                ->copy(),
                            Text::make('okfs')->translatable('contacts')
                                ->mask('99')
                                ->link('https://classifikators.ru/okfs', 'что это?', blank: true)
                                ->copy(),
                            Text::make('kpp')->translatable('contacts')
                                ->mask('999999999')
                                ->link('https://www.consultant.ru/document/cons_doc_LAW_51356/babc0bfad1a4513eb63877381bd5679bb1f7e957/', 'что это?', blank: true)
                                ->copy(),
                            Text::make('okved')->translatable('contacts')
                                ->mask('999999')
                                ->link('https://classifikators.ru/okved', 'что это?', blank: true)
                                ->copy(),
                        ]),
                        Flex::make([
                            Email::make('email')->translatable('contacts'),
                            Phone::make('phone')->translatable('contacts')->mask('+7(999)999-99-99'),
                        ]),
                        Flex::make([
                            Textarea::make('description')->translatable('contacts'),
                        ]),
                    ])->translatable('contacts'),
                ])->columnSpan(8),
                Column::make([
                    Block::make('persons', [
                        BelongsToMany::make(
                            'persons',
                            'persons',
                            fn ($item) => "$item->name $item->surname $item->secname",
                            resource: new PersonResource()
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
            HasMany::make(
                'address',
                'address',
                resource: new AddressResource()
            )->translatable('contacts')
                ->creatable(),

            HasMany::make(
                'bank',
                'bank',
                resource: new BankResource()
            )->translatable('contacts')
                ->creatable(),
        ];
    }

    public function detailFields(): array
    {
        return [
            BelongsTo::make(
                'opf',
                'opf',
                resource: new OpfResource()
            )->translatable('contacts'),
            Text::make('name_full')->translatable('contacts'),
            Text::make('name_short')->translatable('contacts'),
            Text::make('inn')->translatable('contacts'),
            Text::make('ogrn')->translatable('contacts'),
            Text::make('okpo')->translatable('contacts'),
            Text::make('okato')->translatable('contacts'),
            Text::make('oktmo')->translatable('contacts'),
            Text::make('okogu')->translatable('contacts'),
            Text::make('okfs')->translatable('contacts'),
            Text::make('kpp')->translatable('contacts'),
            Text::make('okved')->translatable('contacts'),
            Email::make('email')->translatable('contacts'),
            Phone::make('phone')->translatable('contacts'),
            Text::make('description')->translatable('contacts'),
            Date::make('created_at')->translatable('contacts'),
            Date::make('updated_at')->translatable('contacts'),

            BelongsToMany::make(
                'persons',
                'persons',
                fn ($item) => "$item->name $item->surname $item->secname",
                resource: new PersonResource()
            )->translatable('contacts')
                ->inLine(separator: ' ', badge: true),

            HasMany::make(
                'address',
                'address',
                resource: new AddressResource()
            )->translatable('contacts'),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name_full' => ['required', 'string', 'min:5'],
            'name_short' => ['required', 'string', 'min:3'],
            'inn' => ['nullable', 'digits_between:10,12'],
            'ogrnip' => ['nullable', 'digits:15'],
            'ogrn' => ['nullable', 'digits:13'],
            'okpo' => ['nullable', 'digits_between:8,14'],
            'okato' => ['nullable', 'digits_between:2,11'],
            'oktmo' => ['nullable', 'digits:11'],
            'okogu' => ['nullable', 'digits:7'],
            'okfs' => ['nullable', 'digits:2'],
            'kpp' => ['nullable', 'digits:9'],
            'okved' => ['nullable', 'digits:6'],
            'phone' => ['nullable', 'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/i'],
            'email' => ['nullable', 'email'],
            'description' => ['nullable', 'string', 'min:5'],
        ];
    }

    public function filters(): array
    {
        return [
            BelongsTo::make(
                'opf',
                'opf',
                resource: new OpfResource()
            )->translatable('contacts'),
        ];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: CompanyResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }
}
