<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data :class="$store.darkMode.on && 'dark'">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    {{--
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    --}}

    @moonShineAssets

</head>
<x-moonshine::layout>
    <x-moonshine::layout.flash />

    <x-moonshine::layout.top-bar :home_route="route('home')">
        <x-moonshine::layout.menu>

        </x-moonshine::layout.menu>
        <x-slot:profile>
            @auth
            <x-moonshine::layout.profile route="/profile" :log-out-route="route('logout')" />
            @elseguest
            <x-moonshine::link-button :href="route('home')">
                Войти
            </x-moonshine::link-button>
            @endauth
        </x-slot:profile>
    </x-moonshine::layout.top-bar>

    <main class="layout-page">
        <x-moonshine::grid>
            <x-moonshine::column>
                <x-moonshine::layout.header :notifications="false" :locales="false" />
                <x-moonshine::layout.content />
            </x-moonshine::column>
        </x-moonshine::grid>
    </main>

</x-moonshine::layout>

</html>