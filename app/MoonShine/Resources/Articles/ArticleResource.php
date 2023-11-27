<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Articles;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articles\Article;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Image;

class ArticleResource extends ModelResource
{
    protected string $model = Article::class;

    protected string $title = 'Articles';

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('title'),
            Slug::make('Slug'),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('title')->required(),
            Slug::make('Slug')
                ->from('title')
                ->unique(),
            TinyMce::make('Description'),
            Image::make('thumbnail')
                ->dir('articles'),
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
