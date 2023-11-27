<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Articles\Article;
use App\Models\Products\Product;
use App\MoonShine\Resources\Articles\ArticleResource;
use App\MoonShine\Resources\Contacts\AddressResource;
use App\MoonShine\Resources\Contacts\BankResource;
use App\MoonShine\Resources\Contacts\CompanyResource;
use App\MoonShine\Resources\Contacts\OpfResource;
use App\MoonShine\Resources\Contacts\PersonResource;
use App\MoonShine\Resources\Documents\DocTemplateResource;
use App\MoonShine\Resources\Documents\DocTypeResource;
use App\MoonShine\Resources\Documents\DocumentResource;
use App\MoonShine\Resources\ProductResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
            new AddressResource(),
            new BankResource(),
        ];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('articles', [
                MenuItem::make('articles', new ArticleResource)->icon('heroicons.outline.clipboard-document-list')->translatable('article')
                    ->badge(fn () => strval(Article::query()->count())),
            ])->icon('heroicons.outline.clipboard-document-list')->translatable('article')
                ->canSee(fn () => request()->routeIs('moonshine.*')),

            MenuGroup::make('products', [
                MenuItem::make('products', new ProductResource)->icon('heroicons.outline.gift')->translatable('product')
                    ->badge(fn () => strval(Product::query()->count())),
            ])->icon('heroicons.outline.gift')->translatable('product')
                ->canSee(fn () => request()->routeIs('moonshine.*')),

            MenuGroup::make('docs', [
                MenuItem::make('docs', new DocumentResource)->icon('heroicons.outline.document')->translatable('doc'),
            ])->icon('heroicons.outline.document')->translatable('doc')
                ->canSee(fn () => request()->routeIs('moonshine.*')),

            MenuGroup::make('contacts', [
                MenuItem::make('persons', new PersonResource)->icon('heroicons.outline.users')->translatable('contacts'),
                MenuItem::make('companies', new CompanyResource)->icon('heroicons.outline.building-office-2')->translatable('contacts'),
            ])->icon('heroicons.outline.user-circle')->translatable('contacts')
                ->canSee(fn () => request()->routeIs('moonshine.*')),

            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
                MenuDivider::make(__('directory')),
                MenuItem::make('opfs', new OpfResource)->translatable('contacts'),
                MenuItem::make('doc_type', new DocTypeResource)->translatable('doc'),
                MenuItem::make('doc_template', new DocTemplateResource)->translatable('doc'),
            ])->canSee(fn () => request()->routeIs('moonshine.*')),

            MenuItem::make('article', fn () => route('articles.index'))
                ->canSee(fn () => !request()->routeIs('moonshine.*')),

            MenuItem::make('product', fn () => route('products.index'))
                ->canSee(fn () => !request()->routeIs('moonshine.*')),

        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [
            'colors' => [
                //    'primary' => '#F4A900',
                //    'secondary' => '#A18594',
                //    'body' => '#A18594'
            ]
        ];
    }
}
