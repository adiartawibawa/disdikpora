@section('title', 'Dashboard')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Sekolah') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="text-primary">Sekolah</li>
</x-slot>

<div>
    <div class="grid md:grid-cols-3 col-span-3 gap-4 mb-8 w-full">
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Card title!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
            </div>
        </div>
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Card title!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
            </div>
        </div>
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Card title!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
            </div>
        </div>
    </div>
    <div class="card w-full bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="card-title inline-flex justify-between items-center">
                <h2>Data Sekolah</h2>
                <div>
                    <button class="btn btn-primary btn-sm">
                        <x-icon-o-plus-circle class="w-5 h-5" />
                    </button>
                    <button class="btn btn-sm">
                        <x-icon-o-arrow-up-tray class="w-5 h-5" />
                    </button>
                    <button class="btn btn-sm">
                        <x-icon-o-arrow-down-tray class="w-5 h-5" />
                    </button>
                </div>
            </div>
            <div class="pb-4 flex flex-row items-center justify-between">
                <div class="inline-flex gap-3">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Select</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Pick one</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Select</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Pick one</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input type="text" placeholder="Type here" class="input w-full max-w-xs" />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Favorite Color</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr class="hover">
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
