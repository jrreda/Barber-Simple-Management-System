<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Service Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('service_records.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="barber_id" class="block text-sm font-medium text-gray-700">Barber:</label>
                        <select
                            name="barber_id"
                            id="barber_id"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            @foreach ($barbers as $barber)
                                <option value="{{ $barber->id }}">
                                    {{ $barber->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Service Type:</label>
                        <select
                            name="service_id"
                            id="service_id"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ ucfirst($service->type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="extra_fees" class="block text-sm font-medium text-gray-700">Extra Fees:</label>
                        <input
                            type="number"
                            name="extra_fees"
                            id="extra_fees"
                            value="{{ old('extra_fees') ?? '' }}"
                            placeholder="Extra Fees"
                            step="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes:</label>
                        <textarea
                            name="notes"
                            id="notes"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >{{ old('notes') ?? '' }}</textarea>
                    </div>

                    <div>
                        <label for="service_date" class="block text-sm font-medium text-gray-700">Date:</label>
                        <input
                            type="date"
                            name="service_date"
                            id="service_date"
                            value="{{ old('service_date') ?? date('Y-m-d') }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>

                    <x-primary-button>
                        {{ __('Save') }}
                    </x-primary-button>

                    <a href="{{ route('service_records.index') }}">
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
