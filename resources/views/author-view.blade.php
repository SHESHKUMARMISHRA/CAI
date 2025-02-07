<div>
    {{-- Stop trying to control. --}}
    <table>
        <thead>
            <tr>
                <th>Author Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($author)
            <tr>
                <td> {{ $author['first_name'] }} {{ $author['last_name'] }}</td>
                <td> {{ $author['birthday'] }}</td>
                <td>{{ $author['gender'] }}</td>
                <td>{{ $author['place_of_birth'] }}</p>
                <td> <a href="{{ route('books.show', $author['id']) }}">View Books</a></td>
            </tr>
            @else
            <tr>Author not found.</tr>
            @endif
        </tbody>
    </table>
</div>