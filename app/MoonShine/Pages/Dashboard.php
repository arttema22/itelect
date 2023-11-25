<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Contacts\Company;
use App\Models\Contacts\Person;
use Illuminate\Support\Facades\Auth;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\TextBlock;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Models\MoonshineUser;
use MoonShine\Pages\Page;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    public function components(): array
    {
        return [
            Grid::make([
                Column::make([
                    ValueMetric::make('Companies')->value(Company::query()
                        ->where('user_id', Auth::user()->id)
                        ->count()),
                ])->columnSpan(2),
                Column::make([
                    ValueMetric::make('Persons')->value(Person::query()
                        ->where('user_id', Auth::user()->id)
                        ->count()),
                ])->columnSpan(2),
            ]),
        ];
    }
}
