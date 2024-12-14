<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a New Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('services.store') }}" class="space-y-6">
                    @csrf

                    <div class="w-48">
                        <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                        <select
                            name="type"
                            id="type"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="hair">Hair</option>
                            <option value="beard">Beard</option>
                            <option value="both">Both</option>
                        </select>
                    </div>

                    <div class="w-48">
                        <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ $service->price ?? '' }}"
                            placeholder="Service Fees"
                            step=""
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>

                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>

                    <a href="{{ route('services.index') }}">
                        <x-secondary-button>
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </a>
                </form>

                @if ($errors->any())
                    <div class="mt-6 bg-red-100 text-red-600 p-4 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
