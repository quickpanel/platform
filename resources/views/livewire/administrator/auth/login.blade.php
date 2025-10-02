<x-slot name="title">
    {{ __('platform::common.login') }}
</x-slot>
<form class="mt-4 space-y-4 sm:mt-6 sm:space-y-6" wire:submit="login">
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>
            <input
                type="email"
                wire:model="email"
                id="email"
                class="block w-full rounded-lg border  bg-gray-50 p-2.5 text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                placeholder="{{ __('platform::common.email_placeholder') }}"
                required
            />
            @error('email')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>
            <input
                type="password"
                wire:model="password"
                id="password"
                placeholder="{{ __('platform::common.password_placeholder') }}"
                class="block w-full rounded-lg border  bg-gray-50 p-2.5 text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                required
            />
            @error('password')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input
                id="remember"
                wire:model="remember"
                aria-describedby="remember"
                type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('platform::common.remember_me') }}</label>
        </div>
        <a href="{{ route('administrator.auth.forget-password') }}" class="text-sm font-medium text-primary-700 hover:underline dark:text-primary-500">{{ __('platform::common.forgot_your_password') }}</a>
    </div>
    <div class="flex flex-col items-center justify-center gap-2">
        <button
            type="submit"
            wire:loading.attr="disabled"
            wire:target="login"
            class="w-full rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center"
        >
            <svg wire:loading wire:target="login" class="me-2 h-4 w-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span>{{ __('platform::common.log_in_to_your_account') }}</span>
        </button>
    </div>

</form>
