<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.revenue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" class="mb-6">
                    <div class="flex gap-4">
                        <div>
                            <x-input-label for="start_date" :value="__('messages.start_date')" />
                            <x-text-input id="start_date" type="date" name="start_date" :value="Carbon\Carbon::parse($startDate)->format('Y-m-d')" />
                        </div>
                        <div>
                            <x-input-label for="end_date" :value="__('messages.end_date')" />
                            <x-text-input id="end_date" type="date" name="end_date" :value="Carbon\Carbon::parse($endDate)->format('Y-m-d')" />
                        </div>
                        <div>
                            <x-input-label for="proportion" :value="__('messages.proportion')" />
                            <x-text-input id="proportion" type="number" name="proportion" :value="$proportion" />
                        </div>
                        <div class="mt-6">
                            <x-primary-button type="submit">{{ __('messages.filter') }}</x-primary-button>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">{{ __('messages.barber') }}</th>
                                <th class="px-6 py-3 bg-gray-50 text-right">{{ __('messages.services_count') }}</th>
                                <th class="px-6 py-3 bg-gray-50 text-right">{{ __('messages.total_income') }}</th>
                                <th class="px-6 py-3 bg-gray-50 text-right">{{ __('messages.bonus') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($barberIncomes as $income)
                                <tr>
                                    <td class="px-6 py-4">{{ $income['name'] }}</td>
                                    <td class="px-6 py-4 text-right">{{ $income['services_count'] }}</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($income['total_income'], 2) }}</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($income['bonus'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-right flex gap-2">
                    <h2 class="text-2xl font-bold mb-4">{{ __('messages.total_revenue') }}</h2>
                    <h3 class="text-3xl font-bold text-green-600">{{ number_format($totalIncome, 2) }}</h3>
                    <p class="text-gray-600">{{ __('messages.pound') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
