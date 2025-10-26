<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a class="block mb-4" href="{{ route('services.create') }}">
                        <x-primary-button>
                            {{ __('messages.add_service') }}
                        </x-primary-button>
                    </a>

                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.type') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.price') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.discount') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.final_price') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($services as $service)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($service->type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($service->price, 2) }} {{ __('messages.pound') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->discount_type)
                                            @if($service->discount_type === 'fixed')
                                                <span class="text-green-600">{{ number_format($service->discount_value, 2) }} {{ __('messages.pound') }}</span>
                                            @else
                                                <span class="text-green-600">{{ $service->discount_value }}%</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ number_format($service->final_price, 2) }} {{ __('messages.pound') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                        <a href="{{ route('services.edit', $service) }}">
                                            <x-secondary-button>
                                                {{ __('messages.edit') }}
                                            </x-secondary-button>
                                        </a>

                                        <form method="POST" action="{{ route('services.destroy', $service) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" onclick="return confirm({{ __('messages.service_confirm_delete') }})">
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
