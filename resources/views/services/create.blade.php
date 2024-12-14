<form method="POST" action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}">
    @csrf

    @if(isset($service)) @method('PUT') @endif

    <select name="type" required>
        <option value="hair" {{ (isset($service) && $service->type === 'hair') ? 'selected' : '' }}>Hair</option>
        <option value="beard" {{ (isset($service) && $service->type === 'beard') ? 'selected' : '' }}>Beard</option>
        <option value="both" {{ (isset($service) && $service->type === 'both') ? 'selected' : '' }}>Both</option>
    </select>

    <input type="number" name="price" value="{{ $service->price ?? '' }}" placeholder="Service Fees" step="0.01" required>

    <button type="submit">Save</button>
</form>
