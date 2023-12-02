<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Articles;

use MoonShine\Fields\ID;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Switcher;
use App\Models\Articles\Article;
use MoonShine\Enums\ClickAction;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;

class ArticleResource extends ModelResource
{
    protected string $model = Article::class;

    protected string $title = 'Articles';

    protected ?ClickAction $clickAction = ClickAction::EDIT;

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('title'),
            Switcher::make('is_publish'),
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
            Switcher::make('is_publish'),
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

    public function buttons(): array
    {
        return [
            ActionButton::make(
                'on site',
                fn (Article $data) => route('articles.show', $data->slug)
            ),
        ];
    }
}
