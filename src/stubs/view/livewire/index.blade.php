<x-slot name="title">
    {{ __('platform::common.index') }}
</x-slot>
<x-slot name="breadcrumb">
    <li aria-current="page">
        <div class="flex items-center">
            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{ route('administrator.user-management.admin.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">{{ __('platform::common.admins') }}</a>
        </div>
    </li>
</x-slot>
<div>
    <livewire:platform.administrator.user-management.admin.table/>
</div>
