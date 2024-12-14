
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <a href="{{ route('service_records.create') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Add Service Record') }}</a>

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Barber</th>
                            <th class="px-4 py-2">Service Type</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="border px-4 py-2">{{ $record->barber->name }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($record->service->type) }}</td>
                                <td class="border px-4 py-2">{{ $record->service_date }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('service_records.edit', $record) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form method="POST" action="{{ route('service_records.destroy', $record) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
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
