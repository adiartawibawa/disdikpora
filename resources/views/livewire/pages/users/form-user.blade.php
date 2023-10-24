@section('title', isset($user->id) ? 'Edit Users' : 'Create New Users')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __(isset($user->id) ? 'Edit Users' : 'Create New Users') }}
    </h2>

</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('user.all') }}">Users</a></li>
    <li class="text-primary">{{ isset($user->id) ? 'Edit' : 'Create' }}</li>
</x-slot>

<div>
    <div class="card w-fit bg-base-100 shadow-xl">
        @if (isset($user->id))
            <form wire:submit="update">
            @else
                <form wire:submit="save">
        @endif
        <div class="card-body">
            <div class="card-title inline-flex justify-between items-center">
                <h2>{{ isset($user->id) ? 'Edit user information' : 'Create user information' }}</h2>
            </div>
            <div>
                <div class="flex flex-col md:flex-row md:gap-4">
                    <div class="form-control w-full max-w-xs mb-2">
                        <label class="label">
                            <span class="label-text font-semibold">Full name</span>
                        </label>
                        <input wire:model.blur="form.name" type="text" placeholder="Full Name"
                            class="input input-bordered w-full max-w-xs" />
                        @error('form.name')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control w-full max-w-xs mb-2">
                        <label class="label">
                            <span class="label-text font-semibold">Username</span>
                        </label>
                        <input wire:model.blur="form.username" type="text" placeholder="Username"
                            class="input input-bordered w-full max-w-xs" />
                        @error('form.username')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="form-control w-full max-w-xs mb-2">
                    <label class="label">
                        <span class="label-text font-semibold">Email address</span>
                    </label>
                    <input wire:model.blur="form.email" type="email" placeholder="Email Address"
                        class="input input-bordered w-full max-w-xs" />
                    @error('form.email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row md:gap-4">
                    <div class="form-control w-full max-w-xs mb-2">
                        <label class="label">
                            <span class="label-text font-semibold">Password</span>
                        </label>
                        <input wire:model.blur="form.password" type="password" placeholder="Password"
                            class="input input-bordered w-full max-w-xs" />
                        @error('form.password')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control w-full max-w-xs mb-2">
                        <label class="label">
                            <span class="label-text font-semibold">Confirm Password</span>
                        </label>
                        <input wire:model.blur="form.password_confirmation" type="password"
                            placeholder="Password Confirmation" class="input input-bordered w-full max-w-xs" />
                        @error('form.password_confirmation')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="form-control w-full max-w-xs mb-2">
                    <label class="label">
                        <span class="label-text font-semibold">Select role for user</span>
                    </label>
                    <select wire:model.blur="form.roles" class="select select-bordered w-full max-w-xs">
                        <option selected>All roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-actions justify-end">
                <a href="{{ route('user.all') }}" class="btn btn-ghost" type="button">Back</a>
                <button class="btn btn-primary" type="submit">{{ isset($user->id) ? 'Update' : 'Save' }}</button>
            </div>
        </div>
        </form>
    </div>

</div>
