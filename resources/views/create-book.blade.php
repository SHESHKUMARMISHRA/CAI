@extends('app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <!-- Book Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Author Selection -->
        <div class="mb-3">
            <label for="author_id" class="form-label">Select Author</label>
            <select class="form-control" id="author_id" name="author_id" required>
                <option value="">-- Select an Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Release Date -->
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="datetime-local" class="form-control" id="release_date" name="release_date">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <!-- ISBN -->
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn">
        </div>

        <!-- Format -->
        <div class="mb-3">
            <label for="format" class="form-label">Format</label>
            <input type="text" class="form-control" id="format" name="format">
        </div>

        <!-- Number of Pages -->
        <div class="mb-3">
            <label for="number_of_pages" class="form-label">Number of Pages</label>
            <input type="number" class="form-control" id="number_of_pages" name="number_of_pages">
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection
