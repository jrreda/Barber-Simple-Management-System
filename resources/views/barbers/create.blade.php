<form method="POST" action="{{ isset($barber) ? route('barbers.update', $barber) : route('barbers.store') }}">
    @csrf
    @if(isset($barber)) @method('PUT') @endif
    <input type="text" name="name" value="{{ $barber->name ?? '' }}" placeholder="Barber Name" required>
    <input type="text" name="phone" value="{{ $barber->phone ?? '' }}" placeholder="Phone Number" required>
    <input type="text" name="email" value="{{ $barber->email ?? '' }}" placeholder="Email" required>
    <input type="text" name="address" value="{{ $barber->address ?? '' }}" placeholder="Address" required>
    <button type="submit">Save</button>
</form>
