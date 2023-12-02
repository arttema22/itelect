<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use App\Models\Products\Product;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Enums\ClickAction;

class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

    protected ?ClickAction $clickAction = ClickAction::EDIT;

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Image::make('Thumbnail'),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->required(),
            Slug::make('Slug')->from('name'),
            TinyMce::make('Description')->required(),
            Image::make('Thumbnail')
                ->disk('public')
                ->dir('products')
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
        return [
            'name' => ['required'],
            'description' => ['required'],
        ];
    }

    public function buttons(): array
    {
        return [
            ActionButton::make(
                'on site',
                fn (Product $data) => route('products.show', $data->slug)
            ),
        ];
    }
}
