<?php

namespace QuickPanel\Platform\Livewire\Administrator\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Logout extends Component
{
    /**
     * If the user is not authenticated, send them to the login page immediately.
     */
    public function mount()
    {
        if (! Auth::guard('admin')->check()) {
            // If already logged out, just go to login page
            return redirect()->to(route('administrator.auth.login'));
        }
    }

    /**
     * Confirm the logout action and terminate the authenticated session.
     */
    public function confirmLogout()
    {
        Auth::guard('admin')->logout();

        // Invalidate and regenerate session for security
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // Optional: flash a message to show after redirect
        session()->flash('success', __('platform::common.logged_out'));

        // Redirect to login or home page
        return redirect()->to(route('administrator.auth.login'));
    }

    public function render()
    {
        return view('platform::livewire.administrator.auth.logout')->layout(config('platform.layouts.auth', 'platform::layouts.auth'));
    }
}
