<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('platform::common.direction') }}">
<head>
    @include('platform::layouts.partials.heads')
</head>
<body class="bg-gray-50 dark:bg-gray-900">
<div class="antialiased bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <button
                    data-drawer-target="drawer-navigation"
                    data-drawer-toggle="drawer-navigation"
                    data-drawer-placement="{{ config('platform.sidebar_direction') }}"
                    aria-controls="drawer-navigation"
                    class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <svg
                        aria-hidden="true"
                        class="hidden w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Toggle sidebar</span>
                </button>
                <a href="{{ route('home') }}" class="flex items-center justify-between mr-4">
                    @includeIf('platform::layouts.global.logo', ['class' => 'mr-3 h-8', 'width' => '32px', 'height' => '32px'])
                    <span class="hidden md:inline self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
                </a>
                @include('platform::layouts.global.search')
            </div>
            <div class="flex items-center lg:order-2">
                @include('platform::layouts.global.theme')
                @include('platform::layouts.global.user')
            </div>
        </div>
    </nav>

    <!-- Sidebar -->

    <aside
        @class(['fixed top-0 start-0 z-40 w-64 h-screen pt-14 bg-white border-e border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700',
            'transition-transform -translate-x-full' => (config('platform.sidebar_direction') == 'left'),
            '-transition-transform translate-x-full' => (config('platform.sidebar_direction') == 'right'),
        ])
        aria-label="Sidenav"
        id="drawer-navigation"
    >
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <form action="#" method="GET" class="md:hidden mb-2">
                <label for="sidebar-search" class="sr-only">{{ __('platform::common.search') }}</label>
                <div class="relative">
                    <div
                        class="flex absolute inset-y-0 start-0 items-center ps-3 pointer-events-none"
                    >
                        <svg
                            class="w-5 h-5 text-gray-500 dark:text-gray-400"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        id="sidebar-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full ps-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('platform::common.search') }}"
                    />
                </div>
            </form>
            <ul class="space-y-2">
                <li>
                    <a
                        href="{{ route('user.dashboard.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('user.dashboard.index') ? ' bg-gray-100 dark:bg-gray-700' : ''  }}"
                    >
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ms-3">{{ __('platform::common.dashboard') }}</span>
                    </a>
                </li>
                @includeIf('quick-panel.menus.user')
                <li>
                    <button
                        type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-settings"
                        data-collapse-toggle="dropdown-settings"
                    >
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
                        </svg>

                        <span class="flex-1 ms-3 text-start whitespace-nowrap"
                        >{{ __('platform::common.settings') }}</span
                        >
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <ul id="dropdown-settings" class="py-2 space-y-2 {{ request()->routeIs('user.setting.*') ? '' : ' hidden'  }}">
                        <li>
                            <a
                                href="{{ route('user.setting.profile.index') }}"
                                class="flex items-center p-2 ps-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('user.setting.profile.index') ? ' bg-gray-100 dark:bg-gray-700' : ''  }}"
                            >{{ __('platform::common.profile') }}</a
                            >
                        </li>
                        <li>
                            <a
                                href="{{ route('user.setting.password.index') }}"
                                class="flex items-center p-2 ps-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('user.setting.password.index') ? ' bg-gray-100 dark:bg-gray-700' : ''  }}"
                            >{{ __('platform::common.change_password') }}</a
                            >
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </aside>

    <main class="p-4 md:ms-64 h-auto pt-20">
        {{ $slot }}
    </main>
</div>

@include('platform::layouts.partials.heads')
</body>
</html>
