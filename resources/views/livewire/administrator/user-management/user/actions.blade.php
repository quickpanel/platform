<div class="flex gap-2">
    <!-- Edit -->
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            x-modal:open.preload="{ component: 'platform.administrator.user-management.user.edit', props: { userId: {{ $user->id }} } }">
        {{ __('platform::common.edit') }}
    </button>

    <!-- Roles -->
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800"
            x-modal:open.preload="{ component: 'platform.administrator.user-management.user.roles', props: { userId: {{ $user->id }} } }">
        {{ __('platform::common.roles') }}
    </button>

    <!-- Permissions -->
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800"
            x-modal:open.preload="{ component: 'platform.administrator.user-management.user.permissions', props: { userId: {{ $user->id }} } }">
        {{ __('platform::common.permissions') }}
    </button>

    <!-- Delete -->
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            wire:confirm="{{ __('platform::common.are_you_sure') }}"
            wire:click="deleteUser({{ $user->id }})">
        {{ __('platform::common.delete') }}
    </button>

    @includeIf('quick-panel.administrator.user-management.user.actions', ['user' => $user])
</div>
