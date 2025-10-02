<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('platform::common.direction') }}">
<head>
    @include('platform::layouts.partials.heads')
</head>
<body class="bg-gray-50 dark:bg-gray-900">

<!-- Header -->
<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" class="flex items-center">
                @includeIf('platform::layouts.global.logo', ['class' => 'mr-3 h-6 sm:h-9', 'width' => '32px', 'height' => '32px'])
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
            </a>
            <div class="flex items-center lg:order-2">
                @includeIf('platform::layouts.global.theme')
                @includeIf('platform::layouts.global.action')
            </div>
        </div>
    </nav>
</header>

<!-- Main -->
<main>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto grid h-screen max-w-screen-xl  px-4 py-2.5">
            <div class="w-full place-self-center">
                {{ $slot }}
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl text-center">
        <a href="{{ route('home') }}" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                @include('platform::layouts.global.logo', ['class' => 'mr-2 h-8', 'width' => '33px', 'height' => '33px'])
                {{ config('app.name') }}
        </a>
        <p class="my-6 text-gray-500 dark:text-gray-400">Open-source library of over 400+ web components and interactive elements built for better web.</p>
        <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Premium</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">Campaigns</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Blog</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Affiliate Program</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">FAQs</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Contact</a>
            </li>
        </ul>
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2021-2022 <a href="#" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
    </div>
</footer>

@include('platform::layouts.partials.foots')
</body>
</html>
