<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Logs') }}
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
                        <div class="mt-6">
                            <x-primary-button type="submit">{{ __('messages.filter') }}</x-primary-button>
                        </div>
                    </div>
                </form>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left">{{ __('messages.date') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left">{{ __('messages.user') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left">{{ __('messages.action') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left">{{ __('messages.details') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($logs as $log)
                            <tr>
                                <td class="px-6 py-4">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-6 py-4">{{ $log->user->name }}</td>
                                <td class="px-6 py-4">{{ $log->action }}</td>
                                <td class="px-6 py-4">
                                    <details>
                                        <summary>{{ __('messages.view_changes') }}</summary>
                                        @if($log->old_values)
                                            <div class="mt-2">
                                                <strong>{{ __('messages.old_values') }}</strong>
                                                <pre>{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        @endif
                                        @if($log->new_values)
                                            <div class="mt-2">
                                                <strong>{{ __('messages.new_values') }}</strong>
                                                <pre>{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        @endif
                                    </details>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
