<div class="flex gap-2">
    @can('administrator_user_permission_edit')
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            x-modal:open.preload="{ component: 'platform.administrator.user-management.permission.edit', props: { permissionId: {{ $permission->id }} } }">
        {{ __('platform::common.edit') }}
    </button>
    @endcan

    @can('administrator_user_permission_delete')
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            wire:confirm="{{ __('platform::common.are_you_sure') }}"
            wire:click="delete({{ $permission->id }})">
        {{ __('platform::common.delete') }}
    </button>
    @endcan

    @includeIf('quick-panel.administrator.user-management.permission.actions')
</div>
