
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.service_records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <a class="block mb-4" href="{{ route('service_records.create') }}">
                    <x-primary-button>
                        {{ __('messages.add_record') }}
                    </x-primary-button>
                </a>

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">{{ __('messages.barber') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.service_type') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.price') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.extra_fees') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.notes') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.date') }}</th>
                            <th class="px-4 py-2 border">{{ __('messages.actions') }}</th>
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
                                            {{ __('messages.edit') }}
                                        </x-secondary-button>
                                    </a>

                                    <form method="POST" action="{{ route('service_records.destroy', $record) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" onclick="return confirm({{ __('messages.record_confirm_delete') }})">
                                            {{ __('messages.delete') }}
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
