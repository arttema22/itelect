@extends('layouts.tailwind')

@section('header')
<title>Статьи</title>

@endsection

@section('content')
<div class="grid grid-cols-12 gap-6">
    @foreach ($articles as $article)
    <div class="col-span-12 xl:col-span-6">
        <div
            class="relative flex w-full max-w-[48rem] flex-row rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div
                class="relative w-2/5 m-0 overflow-hidden text-gray-700 bg-white rounded-r-none shrink-0 rounded-xl bg-clip-border">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80"
                    alt="image" class="object-cover w-full h-full" />
            </div>
            <div class="p-6">
                <h6
                    class="block mb-4 font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-pink-500 uppercase">
                    startups
                </h6>
                <h4
                    class="block mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    {{$article->title}}
                </h4>
                <p class="block mb-8 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    {{$article->content}}
                </p>
                <a class="inline-block" href="{{route('articles.show', $article->slug)}}">
                    <button
                        class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-pink-500 uppercase align-middle transition-all rounded-lg select-none hover:bg-pink-500/10 active:bg-pink-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Learn More
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3">
                            </path>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection