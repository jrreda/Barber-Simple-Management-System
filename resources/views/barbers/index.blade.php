<h1>Barbers</h1>

<a href="{{ route('barbers.create') }}">Add Barber</a>

<ul>
    @foreach ($barbers as $barber)
        <li>
            {{ $barber->name }} - {{ $barber->phone }} - {{ $barber->email }} - {{ $barber->address }}
            <a href="{{ route('barbers.show', $barber) }}">View</a>
            <a href="{{ route('barbers.edit', $barber) }}">Edit</a>
            <form method="POST" action="{{ route('barbers.destroy', $barber) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
