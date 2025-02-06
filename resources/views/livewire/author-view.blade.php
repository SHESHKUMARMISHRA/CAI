<div>
    {{-- Stop trying to control. --}}
    <table>
        <thead>
            <tr>
                <th>Author Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
                <tr>
                    <td>{{ $author['first_name'] }}{{ $author['last_name'] }}</td>
                    <td>
                        {{-- <a href="{{ route('author.show', $author['id']) }}">View Books</a> --}}
                        <button wire:click="deleteAuthor({{ $author['id'] }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
