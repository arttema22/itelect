@extends('layouts.app')

@section('content')

<x-moonshine::grid>
    @foreach ($articles as $article)
    <x-moonshine::column colSpan="4">
        <x-moonshine::card url="#" :overlay="true" thumbnail="/images/image_1.jpg" :title="$article->title"
            :subtitle="date('d.m.Y')" :values="['ID' => 1, 'Author' => $article->id]">
            <x-slot:header>
                <x-moonshine::badge color="green">new</x-moonshine::badge>
            </x-slot:header>

            {{ $article }}

            <x-slot:actions>
                <x-moonshine::link-button href="#">Read more</x-moonshine::link-button>
            </x-slot:actions>
        </x-moonshine::card>
    </x-moonshine::column>
    @endforeach
</x-moonshine::grid>
@endsection