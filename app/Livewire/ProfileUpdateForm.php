<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateForm extends Component
{
    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected function rules()
    {
        return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'current_password' => 'required|string',
        'new_password' => ['nullable', 'string', 'confirmed', Password::defaults()],
        ];
    }

    public function mount() {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile() {
        $this->validate();
        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', __('The provided password does not match your current password.'));
            return;
        }

        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->new_password) {
            $user->password = Hash::make($this->new_password);
        }

        $user->save();
        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile-update-form');
    }
}
