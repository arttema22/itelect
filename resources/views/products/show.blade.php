@extends('layouts.app')

@section('content')
<x-moonshine::box>
    <x-moonshine::title>
        {{$product->name}}
    </x-moonshine::title>
    {{ $product->description }}
    <x-moonshine::modal title="Заказать">
        <div>
            <x-moonshine::title>
                {{$product->name}}
            </x-moonshine::title>
            <x-moonshine::form.input name="title" placeholder="Имя" value="" />
            <x-moonshine::form.input name="title" placeholder="Телефон" value="" />
            <x-moonshine::form.button>Заказать</x-moonshine::form.button>
        </div>
        <x-slot name="outerHtml">
            <x-moonshine::link-button>
                Заказать в один клик
            </x-moonshine::link-button>
        </x-slot>
    </x-moonshine::modal>
</x-moonshine::box>

<x-moonshine::divider />

<x-moonshine::table :columns="[
        '#', 'First', 'Last', 'Email'
    ]" :values="[
        [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
        [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
    ]" />

<x-moonshine::divider />

<x-moonshine::grid>
    <x-moonshine::column colSpan="6">
        <x-moonshine::box title="Доставка">
            За соблюдением сроков поставки "Отвечаем рублем" по договору
        </x-moonshine::box>
    </x-moonshine::column>
    <x-moonshine::column colSpan="6">
        <x-moonshine::box title="Оплата">
            Предоставляем отсрочку/рассрочку платежа по договору
        </x-moonshine::box>
    </x-moonshine::column>
</x-moonshine::grid>

<x-moonshine::divider />

<x-moonshine::box title="Свяжитесь со специалистом">
    <x-moonshine::grid>
        <x-moonshine::column adaptiveColSpan="4" colSpan="4">
            <x-moonshine::card thumbnail="/images/image_1.jpg" title="Ксения Полякова">
                Специалист отдела продаж<br>
                +7 (812) 409-91-19, 200<br>
                info@severtradespb.ru
            </x-moonshine::card>
        </x-moonshine::column>
        <x-moonshine::column adaptiveColSpan="4" colSpan="4">
            <x-moonshine::card thumbnail="/images/image_1.jpg" title="Ксения Полякова">
                Специалист отдела продаж<br>
                +7 (812) 409-91-19, 200<br>
                info@severtradespb.ru
            </x-moonshine::card>
        </x-moonshine::column>
        <x-moonshine::column adaptiveColSpan="4" colSpan="4">
            <x-moonshine::card thumbnail="/images/image_1.jpg" title="Ксения Полякова">
                Специалист отдела продаж<br>
                +7 (812) 409-91-19, 200<br>
                info@severtradespb.ru
            </x-moonshine::card>
        </x-moonshine::column>
    </x-moonshine::grid>
</x-moonshine::box>

<x-moonshine::divider />

<x-moonshine::card thumbnail="/images/image_1.jpg">
    Дюралевая труба
    <x-slot:actions>
        <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
    </x-slot:actions>
</x-moonshine::card>

<x-moonshine::divider />

<x-moonshine::card title="У Вас есть сформированный заказ металлопроката, например в Excel?">
    <x-slot:header>
        <x-moonshine::badge color="green">У Вас есть сформированный заказ металлопроката, например в Excel?
        </x-moonshine::badge>
    </x-slot:header>
    У Вас есть сформированный заказ металлопроката, например в Excel?<br>
    <x-moonshine::link-button href="#">Отправьте его нам</x-moonshine::link-button><br>
    В ответ Вы получите коммерческое предложение по стоимости и срокам поставки Вашего заказа.
</x-moonshine::card>

@endsection