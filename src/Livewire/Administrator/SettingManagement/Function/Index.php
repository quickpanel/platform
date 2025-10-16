<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Function;

use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    public function updatePermissions()
    {
        $this->authorize('administrator_setting_function_index');
        Artisan::call(\QuickPanel\Platform\Console\Commands\CreatePermissionsCommand::class);
        Toaster::success(__('platform::common.permissions_updated'));
    }
    public function render()
    {
        return view('platform::livewire.administrator.setting-management.function.index')->layout(config('platform.layouts.administrator', 'platform::layouts.administrator'));
    }
}
