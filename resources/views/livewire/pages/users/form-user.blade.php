@section('title', 'Create Users')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Create Users') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('user.all') }}">Users</a></li>
    <li class="text-primary">Create</li>
</x-slot>

<div>
    <div class="card w-fit bg-base-100 shadow-xl">
        <form wire:submit="save">
            <div class="card-body">
                <div class="card-title inline-flex justify-between items-center">
                    <h2>Create new user</h2>
                </div>
                <div>
                    <div class="flex flex-col md:flex-row md:gap-4">
                        <div class="form-control w-full max-w-xs mb-2">
                            <label class="label">
                                <span class="label-text">Full name</span>
                            </label>
                            <input wire:model.live="form.name" type="text" placeholder="Full Name"
                                class="input input-bordered w-full max-w-xs" />
                            @error('form.name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        <div class="form-control w-full max-w-xs mb-2">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>
                            <input wire:model.live="form.username" type="text" placeholder="Username"
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
                            <span class="label-text">Email address</span>
                        </label>
                        <input wire:model.live="form.email" type="email" placeholder="Email Address"
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
                                <span class="label-text">Password</span>
                            </label>
                            <input wire:model.live="form.password" type="password" placeholder="Password"
                                class="input input-bordered w-full max-w-xs" />
                            @error('form.password')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        <div class="form-control w-full max-w-xs mb-2">
                            <label class="label">
                                <span class="label-text">Password Confirmation</span>
                            </label>
                            <input wire:model.live="form.password_confirmation" type="password"
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
                            <span class="label-text">Select role for user</span>
                        </label>
                        <select wire:model.live="form.roles" class="select select-bordered w-full max-w-xs">
                            <option selected>All roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-actions justify-end">
                    <a href="{{ route('user.all') }}" class="btn btn-ghost" type="button">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>

</div>
