<?php

declare(strict_types=1);

namespace App\MoonShine\Contacts;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Enums\Layer;
use MoonShine\Pages\Page;
use MoonShine\Pages\Crud\FormPage;

class CompanyFormPage extends FormPage
{
    public function components(): array
    {

        //$this->getResource()->getItemID()  - id текущей записи PostResource
        //если нет идентификтора, значит нам нужно стандартное поведение при добавлении записи
        if (!$this->getResource()->getItemID()) {
            return parent::components();
        }

        $bottomComponents = $this->getLayerComponents(Layer::BOTTOM);

        //извлекаем компонент с банками
        $banksComponent = collect($bottomComponents)->filter(fn ($component) => $component->getName() === 'bank')->first();

        //извлекаем компонент с адресами
        $addressesComponent = collect($bottomComponents)->filter(fn ($component) => $component->getName() === 'address')->first();

        //сортируем по табам
        $tabLayer = [
            Block::make('', [
                Tabs::make([
                    Tab::make('data', $this->mainLayer())->translatable('contacts'),
                    Tab::make('addresses', [$addressesComponent])->translatable('contacts'),
                    Tab::make('banks', [$banksComponent])->translatable('contacts'),
                ])
            ])
        ];

        return [
            ...$this->getLayerComponents(Layer::TOP),
            ...$tabLayer,
            //    ...$this->getLayerComponents(Layer::BOTTOM),
        ];
    }
}
