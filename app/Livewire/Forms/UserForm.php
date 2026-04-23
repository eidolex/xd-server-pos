<?php

namespace App\Livewire\Forms;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate(['required', 'string', 'max:100'])]
    public string $nickname = '';

    #[Validate(['nullable', 'string', 'max:20'])]
    public string $phone = '';

    #[Validate(['required', new Enum(UserStatus::class)])]
    public int $status = UserStatus::Active->value;

    public function setUser(User $user): void
    {
        $this->nickname = $user->nickname;
        $this->phone = $user->phone ?? '';
        $this->status = $user->status->value;
    }

    /**
     * Create a new user and return the generated credentials.
     *
     * @return array{username: string, password: string}
     */
    public function store(): array
    {
        $this->validate();

        $username = 'u_'.Str::lower(Str::random(8));
        $plainPassword = Str::random(12);

        $user = new User;
        $user->nickname = $this->nickname;
        $user->username = $username;
        $user->password = $plainPassword;
        $user->phone = $this->phone ?: null;
        $user->role = UserRole::User;
        $user->status = UserStatus::from($this->status);
        $user->save();

        $this->reset();

        return ['username' => $username, 'password' => $plainPassword];
    }

    public function update(User $user): void
    {
        $this->validate();

        $user->nickname = $this->nickname;
        $user->phone = $this->phone ?: null;
        $user->status = UserStatus::from($this->status);
        $user->save();

        $this->reset();
    }
}
