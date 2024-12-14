
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <a href="{{ route('service_records.create') }}">
                    <x-primary-button>
                        {{ __('Add a new Service') }}
                    </x-primary-button>
                </a>

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Barber</th>
                            <th class="px-4 py-2">Service Type</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Extra Fees</th>
                            <th class="px-4 py-2">Notes</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="border px-4 py-2">{{ $record->barber->name }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($record->service->type) }}</td>
                                <td class="border px-4 py-2">{{ $record->service->price }}</td>
                                <td class="border px-4 py-2">{{ $record->extra_fees }}</td>
                                <td class="border px-4 py-2">{{ $record->notes }}</td>
                                <td class="border px-4 py-2">{{ $record->service_date }}</td>
                                <td class="border px-4 py-2 flex gap-2">
                                    <a href="{{ route('service_records.edit', $record->id) }}">
                                        <x-secondary-button>
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                    </a>

                                    <form method="POST" action="{{ route('service_records.destroy', $record) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" onclick="return confirm('Are you sure you want to delete this service?')">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
