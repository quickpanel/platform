<?php

namespace QuickPanel\Platform\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', PasswordRule::min(8), 'confirmed'],
        ];
    }

    public function register()
    {
        $validated = $this->validate();

        // Create the user; password will be hashed via User model casts
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Log the user in
        Auth::login($user, true);

        // Optionally flash a success message
        session()->flash('success', __('Registration successful.'));

        // Redirect to intended location or home
        return redirect()->intended('/');
    }

    #[Layout('platform::layouts.auth')]
    public function render()
    {
        return view('platform::livewire.auth.register');
    }
}
