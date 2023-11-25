<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Documents;

use Illuminate\Database\Eloquent\Model;
use App\Models\Documents\DocType;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;

class DocTypeResource extends ModelResource
{
    protected string $model = DocType::class;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public function title(): string
    {
        return __('doc.doc_type');
    }

    public string $column = 'name';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnIndex()->useOnImport()->showOnExport(),
                Text::make('name')->translatable('contacts')->useOnImport()->showOnExport(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
        ];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: DocTypeResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }

    /*
    * Импорт данных в таблицу
    */
    public function import(): ?ImportHandler
    {
        return ImportHandler::make('import')->translatable('doc');
    }

    /*
    * Экспорт данных из таблицы
    */
    public function export(): ?ExportHandler
    {
        return ExportHandler::make('export')->queue()->translatable('doc');
    }
}
