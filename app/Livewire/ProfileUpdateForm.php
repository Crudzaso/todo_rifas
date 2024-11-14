<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Cloudinary\Api\Upload\UploadApi;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProfileUpdateForm extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $avatar;

    protected function rules()
    {
        return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'current_password' => 'required|string',
        'new_password' => ['nullable', 'string', 'confirmed', Password::defaults()],
        'avatar' => 'nullable|image|max:1024',
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

        if ($this->avatar) {
            // Upload image to Cloudinary
            $uploadedImage = $this->uploadImageToCloudinary($this->avatar);

            // Update the user profile with the Cloudinary image URL
            auth()->user()->update([
                'name' => $this->name,
                'email' => $this->email,
                'avatar' => $uploadedImage['secure_url'], // Save the Cloudinary image URL in the database
            ]);
        } else {
            // Just update name and email if no new image
            auth()->user()->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }

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

    // Method to upload image to Cloudinary
    private function uploadImageToCloudinary($image)
    {
        $uploadApi = new UploadApi();
        $response = $uploadApi->upload($image->getRealPath(), [
            'folder' => 'user_avatars', // Optional: Set folder for uploaded images
            'public_id' => 'avatar_' . time(), // Optional: Use unique name
        ]);
        
        return $response; // Return Cloudinary response containing the image URL
    }

    public function render()
    {
        return view('livewire.profile-update-form');
    }
}
