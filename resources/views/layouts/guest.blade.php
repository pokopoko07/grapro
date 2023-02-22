<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="w-full container mx-auto p-6">
            <div class="w-full flex items-center justify-between">
                <a href="{{route('top')}}">
                    <img src="{{asset('logo/arakashi_logo.png')}}"  style="max-height:80px;">
                </a>
                <div class="w-full container mx-auto p-6">
                    <div class="w-full flex items-center justify-between">
                <div class="flex w-1/2 justify-end content-center">
                    {{-- ログイン・登録部分 --}}
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/post') }}" class="text-xl text-gray-700 dark:text-gray-500 underline">HOME</a>
                        @else
                            <a href="{{ route('login') }}" class="text-xl text-gray-700 dark:text-gray-500 underline font-bold text-base">ログイン</a>
        
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-xl text-gray-700 dark:text-gray-500 underline font-bold text-base">新規登録</a>
                            @endif
                        @endauth
                        </div>
                    @endif
                    
                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
