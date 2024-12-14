<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create service record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('service_records.store') }}">
                    @csrf
                    @if(isset($serviceRecord)) @method('PUT') @endif

                    <label for="barber_id">Barber:</label>
                    <select name="barber_id" required>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ ($barber->id) ? 'selected' : '' }}>
                                {{ $barber->name }}
                            </option>
                        @endforeach
                    </select>

                    <label for="service_id">Service Type:</label>
                    <select name="service_id" required>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ ($service) ? 'selected' : '' }}>
                                {{ ucfirst($service->type) }}
                            </option>
                        @endforeach
                    </select>

                    <label for="extra_fees">Extra Fees:</label>
                    <input type="number" name="extra_fees" value="" placeholder="Extra Fees" step="0.01">

                    <label for="notes">Notes</label>
                    <textarea name="notes" rows="4"></textarea>

                    <label for="service_date">Date:</label>
                    <input type="date" name="service_date" value="{{ date('Y-m-d') }}" required>

                    <button type="submit">Save</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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
