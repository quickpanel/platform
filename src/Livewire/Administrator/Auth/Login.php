<?php

namespace QuickPanel\Platform\Livewire\Administrator\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    public function login()
    {
        $validated = $this->validate();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (! Auth::guard('admin')->attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Regenerate session to prevent fixation
        request()->session()->regenerate();

        // Clear sensitive field
        $this->reset('password');

        // Redirect to intended page or dashboard
        return redirect()->intended(route('administrator.dashboard.index'));
    }

    public function render()
    {
        return view('platform::livewire.administrator.auth.login')->layout(config('platform.layouts.auth', 'platform::layouts.auth'));
    }
}
