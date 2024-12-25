<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.barbers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a class="block mb-4" href="{{ route('barbers.create') }}">
                        <x-primary-button>
                            {{ __('messages.add_barber') }}
                        </x-primary-button>
                    </a>

                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.name') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.phone') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.email') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.address') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($barbers as $barber)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($barber->name) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barber->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barber->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barber->address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                        <a href="{{ route('barbers.edit', $barber) }}">
                                            <x-secondary-button>
                                                {{ __('messages.edit') }}
                                            </x-secondary-button>
                                        </a>

                                        <form method="POST" action="{{ route('barbers.destroy', $barber) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" onclick="return confirm({{ __('messages.barber_confirm_delete') }})">
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
    </div>
</x-app-layout>
