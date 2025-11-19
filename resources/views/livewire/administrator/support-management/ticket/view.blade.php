<x-slot name="title">
    {{ __('platform::common.view_ticket') }}: {{ $ticket->title }}
</x-slot>

<div class="space-y-6" x-data="{ imageModal: { open: false, url: '', title: '' } }">
    <!-- Ticket header -->
    <div class="p-4 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700 space-y-2">
        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $ticket->title }}</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('platform::common.by') }}: {{ optional($ticket->user)->name }}
            • {{ $ticket->created_at?->format('Y-m-d H:i') }}
        </div>

        @if($ticket->files && $ticket->files->count())
            <div class="mt-3">
                <div class="font-medium mb-2 text-gray-900 dark:text-white">{{ __('platform::common.attachments') }}</div>
                <div class="flex flex-wrap gap-2">
                    @foreach($ticket->files as $file)
                        @if($file->isImage())
                            <button
                                type="button"
                                x-on:click="imageModal = { open: true, url: '{{ $file->file_url }}', title: '{{ addslashes($file->title ?: basename($file->file)) }}' }"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-colors"
                            >
                                {{ $file->title ?: basename($file->file) }}
                            </button>
                        @else
                            <a
                                href="{{ $file->file_url }}"
                                download
                                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-colors"
                            >
                                {{ $file->title ?: basename($file->file) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Replays list -->
    <div class="space-y-4">
        <div class="text-md font-semibold text-gray-900 dark:text-white">{{ __('platform::common.replies') }}</div>
        @forelse($this->replays as $replay)
            <x-flowbite-ui::card class="space-y-2">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ optional($replay->user)->name }} • {{ $replay->created_at?->format('Y-m-d H:i') }}
                </div>
                <div class="prose max-w-none text-gray-900 dark:text-gray-100">{!! nl2br(e($replay->body)) !!}</div>

                @if($replay->files && $replay->files->count())
                    <div class="mt-2">
                        <div class="font-medium mb-1 text-sm text-gray-900 dark:text-white">{{ __('platform::common.attachments') }}</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($replay->files as $file)
                                @if($file->isImage())
                                    <button
                                        type="button"
                                        x-on:click="imageModal = { open: true, url: '{{ $file->file_url }}', title: '{{ addslashes($file->title ?: basename($file->file)) }}' }"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-colors"
                                    >
                                        {{ $file->title ?: basename($file->file) }}
                                    </button>
                                @else
                                    <a
                                        href="{{ $file->file_url }}"
                                        download
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-colors"
                                    >
                                        {{ $file->title ?: basename($file->file) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </x-flowbite-ui::card>
        @empty
            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('platform::common.no_data_found') }}</div>
        @endforelse
    </div>

    <!-- Reply form -->
    <x-flowbite-ui::card>
        <form class="space-y-3">
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">{{ __('platform::common.message') }}</label>
                <textarea
                    wire:model.defer="body"
                    rows="5"
                    class="w-full border border-gray-300 rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                ></textarea>
                @error('body')
                    <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end">
                <x-flowbite-ui::button wire:click="submitReplay" type="submit" variant="solid" color="primary">{{ __('platform::common.send') }}</x-flowbite-ui::button>
            </div>
        </form>
    </x-flowbite-ui::card>

    <!-- Image Modal -->
    <div
        x-show="imageModal.open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="imageModal.open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="imageModal.open" x-transition.opacity class="fixed inset-0 bg-black/50 dark:bg-black/75"></div>

        <!-- Panel -->
        <div
            x-show="imageModal.open"
            x-transition
            x-on:click="imageModal.open = false"
            class="relative flex min-h-screen items-center justify-center p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="imageModal.open"
                class="relative min-w-96 max-w-4xl rounded-xl bg-white dark:bg-gray-800 p-6 shadow-lg"
            >
                <!-- Title -->
                <h2 class="font-medium text-gray-800 dark:text-white mb-4" :id="$id('modal-title')" x-text="imageModal.title"></h2>

                <!-- Image Content -->
                <div class="mt-2">
                    <img
                        :src="imageModal.url"
                        :alt="imageModal.title"
                        class="max-w-full h-auto rounded-lg"
                    />
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-2">
                    <button
                        type="button"
                        x-on:click="imageModal.open = false"
                        class="relative flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-transparent bg-transparent px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    >
                        {{ __('platform::common.close') }}
                    </button>

                    <a
                        :href="imageModal.url"
                        download
                        x-on:click="imageModal.open = false"
                        class="relative flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-transparent bg-gray-800 dark:bg-gray-700 px-4 py-2 text-white hover:bg-gray-900 dark:hover:bg-gray-600 transition-colors"
                    >
                        {{ __('platform::common.download') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
