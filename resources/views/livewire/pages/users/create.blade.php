<div>
    <form wire:submit="save">
        <input type="text" wire:model.live="form.name">
        <div>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="text" wire:model.live="form.username">
        <div>
            @error('form.username')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="email" wire:model.live="form.email">
        <div>
            @error('form.email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="password" wire:model.live="form.password">
        <div>
            @error('form.password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="password" wire:model.live="form.password_confirmation">
        <div>
            @error('form.password_confirmation')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <select wire:model.live="form.roles">
            <option value="">Semua Roles</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>

        <button type="submit">Save</button>
    </form>
</div>
