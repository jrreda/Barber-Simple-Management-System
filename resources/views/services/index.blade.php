<h1>Services</h1>

<a href="{{ route('services.create') }}">Add Service</a>

<ul>
    @foreach ($services as $service)
        <li>
            {{ $service->type }}: ${{ $service->price }}
            <a href="{{ route('services.show', $service) }}">View</a>
            <a href="{{ route('services.edit', $service) }}">Edit</a>
            <form method="POST" action="{{ route('services.destroy', $service) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
