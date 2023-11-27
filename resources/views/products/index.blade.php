@extends('layouts.app')

@section('content')
<x-moonshine::grid>
    @foreach ($products as $product)
    <x-moonshine::column colSpan="4">
        <x-moonshine::card :url="route('products.show', $product->slug)" :overlay="true"
            :thumbnail="$product->thumbnail" :title="$product->name" {{-- :subtitle="date('d.m.Y')" {{--
            :values="['ID' => 1, 'Author' => $product->id]" --}}>
            {{-- <x-slot:header>
                <x-moonshine::badge color="green">new</x-moonshine::badge>
            </x-slot:header> --}}

            {{ $product->description }}

            <x-slot:actions>
                <x-moonshine::link-button :href="route('products.index', $product->slug)">Read more
                </x-moonshine::link-button>
            </x-slot:actions>
        </x-moonshine::card>
    </x-moonshine::column>
    @endforeach
</x-moonshine::grid>
@endsection