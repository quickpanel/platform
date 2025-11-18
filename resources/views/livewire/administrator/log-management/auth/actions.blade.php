<div class="flex gap-2">
    <!-- Edit -->
    <button type="button"
            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            x-modal:open="{ component: 'platform.administrator.user-management.log.view', props: { AuthenticationLogId: {{ $AuthenticationLog->id }} } }">
        {{ __('platform::common.view') }}
    </button>

    @includeIf('quick-panel.administrator.log-management.auth.actions', ['AuthenticationLog' => $AuthenticationLog])
</div>
