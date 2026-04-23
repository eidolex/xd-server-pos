<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.auth')] #[Title('Sign In')] class extends Component {
    public string $username = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt(['username' => strtolower($this->username), 'password' => $this->password], $this->remember)) {
            $this->addError('username', 'These credentials do not match our records.');

            return;
        }

        session()->regenerate();

        $this->redirect(route('dashboard'), navigate: true);
    }
};

?>

<div class="w-full max-w-sm">

    {{-- Brand --}}
    <div class="mb-10 text-center">
        <div class="text-2xl font-headline font-extrabold tracking-widest uppercase text-text mb-1">Sovereign POS</div>
        <p class="text-2xs uppercase tracking-wider text-muted font-bold">Dashboard Access</p>
    </div>

    {{-- Card --}}
    <div class="bg-surface border border-border p-8">

        <form wire:submit="login" novalidate>

            {{-- Username --}}
            <div class="flex flex-col gap-1.5 mb-5">
                <x-ui.form.label for="id_username">Username</x-ui.form.label>
                <x-ui.form.input id="id_username" type="text" wire:model="username" />
                @error('username')
                    <span class="text-2xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col gap-1.5 mb-6" x-data="{ show: false }">
                <x-ui.form.label for="password">Password</x-ui.form.label>
                <div class="relative">
                    <x-ui.form.input
                        id="password"
                        type="password"
                        x-bind:type="show ? 'text' : 'password'"
                        wire:model="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        class="pr-10"
                    />
                    <button
                        type="button"
                        x-on:click="show = !show"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-muted hover:text-text transition-colors cursor-pointer"
                        tabindex="-1"
                    >
                        <span class="material-symbols-outlined text-lg" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                @error('password')
                    <span class="text-2xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="flex items-center gap-2 mb-8">
                <input id="remember" type="checkbox" wire:model="remember" class="w-3.5 h-3.5 accent-text cursor-pointer" />
                <x-ui.form.label for="remember" class="cursor-pointer">Remember me</x-ui.form.label>
            </div>

            {{-- Submit --}}
            <x-ui.form.button
                type="submit"
                variant="primary"
                :full="true"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-60 cursor-not-allowed"
            >
                <span wire:loading.remove>Sign In</span>
                <span wire:loading class="flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-base animate-spin">progress_activity</span>
                    Signing in…
                </span>
            </x-ui.form.button>

        </form>

    </div>

</div>
