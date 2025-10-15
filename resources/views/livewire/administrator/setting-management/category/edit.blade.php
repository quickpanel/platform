<x-livewire-modal::stack>
    <x-livewire-modal::slideover
            position="{{ config('platform.slide_over_direction')  }}"
            class="w-full max-w-md overflow-auto rounded-lg bg-white dark:bg-gray-800 p-5"
    >
        <div class="flex flex-row items-center gap-2 mb-4">
            <h5 class="inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0  0 1 1 1v4h1a1 1 0  0 1 0 2Z"/>
                </svg>{{ __('platform::common.edit_category') }}: {{ $title }}</h5>
            <button type="button" wire:click="$dispatch('modal-close')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>


        <form wire:submit.prevent="update">
            <div>
                <label class="{{ $errors->has('title') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.title') }}</label>
                <input type="text" wire:model.defer="title" class="{{ $errors->has('title')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}" />
                @error('title')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('type') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.type') }}</label>
                <select wire:model.defer="type" class="{{ $errors->has('type')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}">
                    @foreach(config('platform.types', []) as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('type')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('icon') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.icon') }}</label>
                <input type="text" wire:model.defer="icon" class="{{ $errors->has('icon')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}" />
                @error('icon')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('image') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.image') }}</label>
                <input type="text" wire:model.defer="image" class="{{ $errors->has('image')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}" />
                @error('image')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('language') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.language') }}</label>
                <select wire:model.defer="language" class="{{ $errors->has('language')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}">
                    @foreach(config('platform.languages', []) as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('language')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('description') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.description') }}</label>
                <textarea wire:model.defer="description" rows="3" class="{{ $errors->has('description')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}"></textarea>
                @error('description')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="{{ $errors->has('sort_order') ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' : 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' }}">{{ __('platform::common.sort_order') }}</label>
                <input type="number" min="1" wire:model.defer="sort_order" class="{{ $errors->has('sort_order')
                    ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' }}" />
                @error('sort_order')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="mt-6 flex items-center justify-center gap-4 w-full">
                <button type="button" wire:click="$dispatch('modal-close')" class="flex-1 py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <span>{{ __('platform::common.cancel') }}</span>
                </button>
                <button type="submit" wire:loading.attr="disabled" wire:target="update" class="flex-1 inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5 4a1 1 0 0 1 1-1h5.586a1 1 0 0 1 .707.293l3.414 3.414A1 1 0 0 1 16 7H6a1 1 0 0 1-1-1V4Zm-1 5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9Zm3 2a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H7Z"/>
                    </svg>
                    <span>{{ __('platform::common.update') }}</span>
                    <svg wire:loading wire:target="update" class="w-4 h-4 ms-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </x-livewire-modal::slideover>
</x-livewire-modal::stack>
