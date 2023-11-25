<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Articles;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articles\Article;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

class ArticleResource extends ModelResource
{
    protected string $model = Article::class;

    protected string $title = 'Articles';

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('title'),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
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
}
