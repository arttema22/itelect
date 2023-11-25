<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Documents;

use Illuminate\Database\Eloquent\Model;
use App\Models\Documents\DocTemplate;
use App\Models\Documents\DocType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\File;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\QueryTags\QueryTag;
use App\Http\PrintForm\PrintFormProcessor;
use MoonShine\ActionButtons\ActionButton;

class DocTemplateResource extends ModelResource
{
    protected string $model = DocTemplate::class;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public function title(): string
    {
        return __('doc.doc_template');
    }

    public function buttons(): array
    {
        return [
            ActionButton::make('download', function () {
                $this->downloadPrintForm();
            })->translatable('doc'),
        ];
    }

    public function fields(): array
    {
        return [
            Hidden::make('user_id')->fill(Auth::user()->id)
                ->hideOnIndex(),
            Block::make([
                BelongsTo::make(
                    'doctype',
                    'doctype',
                    resource: new DocTypeResource()
                )->translatable('doc')->useOnImport()->showOnExport(),
                Text::make('name')->translatable('doc')->required()->useOnImport()->showOnExport(),
                File::make('path')->translatable('doc')->required()
                    ->dir('doctemplates')
                    ->removable()->useOnImport()->showOnExport(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function queryTags(): array
    {
        return [
            QueryTag::make(
                'Все',
                fn (Builder $query) => $query
            )->icon('heroicons.users'),
            QueryTag::make(
                'Договор',
                fn (Builder $query) => $query->where('doctype_id', 1)
            )->icon('heroicons.users'),
            QueryTag::make(
                'Счет-Договор',
                fn (Builder $query) => $query->where('doctype_id', 2)
            )->icon('heroicons.users'),
            QueryTag::make(
                'Счет',
                fn (Builder $query) => $query->where('doctype_id', 3)
            )->icon('heroicons.users'),
            QueryTag::make(
                'Акт',
                fn (Builder $query) => $query->where('doctype_id', 4)
            )->icon('heroicons.users'),
        ];
    }

    /*
    * перенаправление после сохранения
    */
    public function redirectAfterSave(): string
    {
        return to_page(resource: DocTemplateResource::class);
    }

    /*
    * разрешенные действия
    */
    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }

    public function downloadPrintForm()
    {
        $id = 1;
        $entity = DocTemplate::find($id);
        $printFormProcessor = new PrintFormProcessor();
        $templateFile = 'storage/test.docx';
        $tempFileName = $printFormProcessor->process($templateFile, $entity);
        // dd($tempFileName);
        // $filename = 'contract_' . $id;
        // return response()
        //     ->download($tempFileName, $filename . '.docx')
        //     ->deleteFileAfterSend();
    }
}
