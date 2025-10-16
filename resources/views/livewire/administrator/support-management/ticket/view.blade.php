<x-slot name="title">
    {{ __('platform::common.view_ticket') }}: {{ $ticket->title }}
</x-slot>

<div class="space-y-6">
    <!-- Ticket header -->
    <div class="p-4 border rounded bg-white space-y-2">
        <div class="text-lg font-semibold">{{ $ticket->title }}</div>
        <div class="text-sm text-gray-600">
            {{ __('platform::common.by') }}: {{ optional($ticket->user)->name }}
            • {{ $ticket->created_at?->format('Y-m-d H:i') }}
        </div>

        @if($ticket->files && $ticket->files->count())
            <div class="mt-3">
                <div class="font-medium mb-2">{{ __('platform::common.attachments') }}</div>
                <div class="flex flex-wrap gap-2">
                    @foreach($ticket->files as $file)
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($file->file) }}" download class="inline-flex items-center px-3 py-1.5 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                            {{ $file->title ?: basename($file->file) }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Replays list -->
    <div class="space-y-4">
        <div class="text-md font-semibold">{{ __('platform::common.replies') }}</div>
        @forelse($ticket->replays as $replay)
            <x-flowbite-ui::card class="space-y-2">
                <div class="text-sm text-gray-600">
                    {{ optional($replay->user)->name }} • {{ $replay->created_at?->format('Y-m-d H:i') }}
                </div>
                <div class="prose max-w-none">{!! nl2br(e($replay->body)) !!}</div>

                @if($replay->files && $replay->files->count())
                    <div class="mt-2">
                        <div class="font-medium mb-1 text-sm">{{ __('platform::common.attachments') }}</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($replay->files as $file)
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($file->file) }}" download class="inline-flex items-center px-3 py-1.5 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                                    {{ $file->title ?: basename($file->file) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </x-flowbite-ui::card>
        @empty
            <div class="text-sm text-gray-600">{{ __('platform::common.no_data_found') }}</div>
        @endforelse
    </div>

    <!-- Reply form -->
    <x-flowbite-ui::card>
        <form class="space-y-3">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('platform::common.message') }}</label>
                <textarea wire:model.defer="body" rows="5" class="w-full border rounded p-2"></textarea>
                @error('body') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="flex justify-end">
                <x-flowbite-ui::button wire:click="submitReplay" type="submit" variant="solid" color="primary">{{ __('platform::common.send') }}</x-flowbite-ui::button>
            </div>
        </form>
    </x-flowbite-ui::card>
</div>
