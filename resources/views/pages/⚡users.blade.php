<?php

use App\Enums\UserRole;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public UserForm $form;

    public string $search = '';
    public string $sortBy = 'created_at';
    public string $sortDir = 'desc';

    public ?string $editingUserId = null;

    public function edit(string $id): void
    {
        $user = User::findOrFail($id);
        $this->editingUserId = $user->id;
        $this->form->setUser($user);
    }

    public function cancelEdit(): void
    {
        $this->editingUserId = null;
        $this->form->reset();
    }

    public function save(): void
    {
        if ($this->editingUserId) {
            $user = User::findOrFail($this->editingUserId);
            $this->form->update($user);
            $this->editingUserId = null;
        } else {
            $this->form->store();
        }

        unset($this->users);
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }

    public function dismissCredentials(): void
    {
        $this->generatedUsername = null;
        $this->generatedPassword = null;
    }

    #[Computed]
    public function users()
    {
        return User::query()
            ->where('role', UserRole::User->value)
            ->when(
                $this->search,
                fn ($q) => $q->where('nickname', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%")
            )
            ->orderBy($this->sortBy, $this->sortDir)
            ->get(['id', 'nickname', 'phone', 'created_at']);
    }
};

?>

<div class="flex flex-col md:flex-row flex-1 min-h-0 overflow-hidden overflow-y-auto md:overflow-hidden">

    {{-- ══ LEFT: User List ══ --}}
    <div class="flex-1 flex flex-col min-h-0 min-w-0 border-b md:border-b-0 md:border-r border-border order-2 md:order-1">

        {{-- Toolbar --}}
        <div class="px-5 py-4 border-b border-border flex items-center gap-4 shrink-0">
            <span class="text-2xs uppercase tracking-widest font-bold text-subtext">Users</span>
            <div class="flex-1 max-w-64">
                <x-ui.form.input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search nickname or phone…"
                    class="py-2 text-xs"
                />
            </div>
            <span class="text-2xs text-muted font-bold ml-auto">{{ $this->users->count() }} records</span>
        </div>

        {{-- Table --}}
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-bg z-10 border-b border-border">
                    <tr>
                        <th class="px-5 py-3 w-68">
                            <button wire:click="sort('id')" class="flex items-center gap-1 text-3xs uppercase tracking-wider text-muted font-bold hover:text-text transition-colors cursor-pointer">
                                ID
                                @if($sortBy === 'id')
                                    <span class="material-symbols-outlined text-xs">{{ $sortDir === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-5 py-3">
                            <button wire:click="sort('nickname')" class="flex items-center gap-1 text-3xs uppercase tracking-wider text-muted font-bold hover:text-text transition-colors cursor-pointer">
                                Nickname
                                @if($sortBy === 'nickname')
                                    <span class="material-symbols-outlined text-xs">{{ $sortDir === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-5 py-3 w-40">
                            <button wire:click="sort('phone')" class="flex items-center gap-1 text-3xs uppercase tracking-wider text-muted font-bold hover:text-text transition-colors cursor-pointer">
                                Phone
                                @if($sortBy === 'phone')
                                    <span class="material-symbols-outlined text-xs">{{ $sortDir === 'asc' ? 'arrow_upward' : 'arrow_downward' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-5 py-3 w-10"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->users as $user)
                        <tr
                            wire:key="{{ $user->id }}"
                            class="border-b border-border transition-colors {{ $editingUserId === $user->id ? 'bg-panel' : 'hover:bg-surface' }}"
                        >
                            <td class="px-5 py-3.5">
                                <span class="text-2xs text-muted font-mono">{{ $user->id }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-sm font-medium text-text">{{ $user->nickname }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-sm text-subtext">{{ $user->phone ?? '—' }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <button
                                    wire:click="edit('{{ $user->id }}')"
                                    class="material-symbols-outlined text-base text-muted hover:text-text transition-colors cursor-pointer {{ $editingUserId === $user->id ? 'text-text' : '' }}"
                                >edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center">
                                <span class="material-symbols-outlined text-3xl text-muted block mb-2">group</span>
                                <span class="text-2xs uppercase tracking-wider text-muted font-bold">No users found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- ══ RIGHT: Form Panel ══ --}}
    <div class="w-full md:w-80 shrink-0 flex flex-col bg-surface p-5 gap-4 overflow-y-auto custom-scrollbar order-1 md:order-2">

        {{-- Panel header --}}
        <div class="flex items-center justify-between">
            <span class="text-2xs uppercase tracking-widest font-bold text-subtext">
                {{ $editingUserId ? 'Edit User' : 'New User' }}
            </span>
            @if($editingUserId)
                <button wire:click="cancelEdit" class="material-symbols-outlined text-base text-muted hover:text-text transition-colors cursor-pointer">close</button>
            @endif
        </div>

        {{-- Form --}}
        <form wire:submit="save" class="flex flex-col gap-4">

            <div class="flex flex-col gap-1.5">
                <x-ui.form.label for="nickname">
                    Nickname <span class="text-red-500">*</span>
                </x-ui.form.label>
                <x-ui.form.input
                    id="nickname"
                    wire:model="form.nickname"
                    placeholder="e.g. John"
                />
                @error('form.nickname')
                    <span class="text-2xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <x-ui.form.label for="phone">
                    Phone <span class="text-muted text-3xs normal-case tracking-normal">(optional)</span>
                </x-ui.form.label>
                <x-ui.form.input
                    id="phone"
                    wire:model="form.phone"
                    placeholder="e.g. 09123456789"
                />
                @error('form.phone')
                    <span class="text-2xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <x-ui.form.label for="status">Status</x-ui.form.label>
                <x-ui.form.select id="status" wire:model="form.status">
                    @foreach(\App\Enums\UserStatus::cases() as $case)
                        <option value="{{ $case->value }}">{{ $case->name }}</option>
                    @endforeach
                </x-ui.form.select>
                @error('form.status')
                    <span class="text-2xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <x-ui.form.button
                type="submit"
                variant="primary"
                :full="true"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-60 cursor-not-allowed"
            >
                <span wire:loading.remove wire:target="save">
                    {{ $editingUserId ? 'Update User' : 'Save User' }}
                </span>
                <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-base animate-spin">progress_activity</span>
                    {{ $editingUserId ? 'Updating…' : 'Saving…' }}
                </span>
            </x-ui.form.button>

        </form>

    </div>

</div>
