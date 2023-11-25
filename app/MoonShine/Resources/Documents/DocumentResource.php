<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Documents;

use App\Models\Contacts\Company;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documents\Document;
use App\MoonShine\Resources\Contacts\CompanyResource;
use Illuminate\Support\Facades\Auth;
use MoonShine\Fields\Date;
use MoonShine\Fields\File;
use MoonShine\Fields\Hidden;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

class DocumentResource extends ModelResource
{
    protected string $model = Document::class;

    public function title(): string
    {
        return __('doc.docs');
    }

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    public function formFields(): array
    {
        return [
            Hidden::make('user_id')->fill(Auth::user()->id),
            BelongsTo::make(
                'doctype',
                'doctype',
                resource: new DocTypeResource()
            )->translatable('doc'),

            BelongsTo::make(
                'company',
                'company',
                resource: new CompanyResource()
            )->translatable('doc'),

            Date::make('date')->translatable('doc'),
            Text::make('number')->translatable('doc'),
            Date::make('validity_period')->translatable('doc'),
            File::make('path')->translatable('contacts')->required()
                ->dir('doctemplates')
                ->removable(),
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: DocumentResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }
}
