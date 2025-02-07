<!-- resources/views/livewire/authors-table.blade.php -->
@extends('app')  <!-- Correctly reference the app layout -->

@section('content')

    <h1>Authors List</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Birth Place</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->first_name }}</td>
                    <td>{{ $author->last_name }}</td>
                    <th>{{ $author->gender }}</th>
                    <td>{{ date('m/d/Y H:i:s',strtotime($author->birthday)) }}</td>
                    <td>{{ $author->place_of_birth }}</td>
                    <td>
                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info">View</a>
                        <button class="btn btn-danger delete-author" data-id="{{ $author->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Show success/error message -->
    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif   

    <script>
        $(document).on('click', '.delete-author', function() {
            let authorId = $(this).data('id');
            if (confirm("Are you sure you want to delete this author?")) {
                $.ajax({
                    url: '/authors/' + authorId,
                    type: 'DELETE',                   
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(response, textStatus, xhr) {
                        alert('Author deleted successfully');
                        console.log("Response Code:", xhr.status); // Log the response code
                        location.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert(xhr.responseJSON.error || "Error deleting author.");
                        console.log("Response Code:", xhr.status); // Log the response code
                    }
                });
            }
        });
    </script>
@endsection