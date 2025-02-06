<div>
    <!-- resources/views/livewire/profile.blade.php -->

    @if($author)
    <p><strong>Name:</strong> {{ $author['first_name'] }} {{ $author['last_name'] }}</p>
    <p><strong>Birthday:</strong> {{ $author['birthday'] }}</p>
    <p><strong>Gender:</strong> {{ $author['gender'] }}</p>
    <p><strong>Place of Birth:</strong> {{ $author['place_of_birth'] }}</p>
    <p><strong> <a href="{{ route('books.show', $author['id']) }}">View Books</a></strong></p>
    @else
    <p>Author not found.</p>
    @endif
</div>