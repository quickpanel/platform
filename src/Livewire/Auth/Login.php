<?php

namespace QuickPanel\Platform\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public string $captcha = '';
    public bool $remember = false;
    public string $captchaSrc = '';

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'captcha' => ['required', 'string', 'captcha'],
            'remember' => ['boolean'],
        ];
    }

    public function mount(): void
    {
        $this->refreshCaptcha();
    }

    public function refreshCaptcha(): void
    {
        // Generate a fresh captcha image source and clear the input value
        $this->captchaSrc = captcha_src();
        $this->captcha = '';
    }

    public function login()
    {
        $validated = $this->validate();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (! Auth::attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Regenerate session to prevent fixation
        request()->session()->regenerate();

        // Clear sensitive field
        $this->reset('password');

        // Redirect to intended page or dashboard
        return redirect()->intended(route('user.dashboard.index'));
    }

    #[Layout('platform::layouts.auth')]
    public function render()
    {
        return view('platform::livewire.auth.login');
    }
}
