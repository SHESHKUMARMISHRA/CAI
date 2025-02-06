<!-- resources/views/livewire/books-table.blade.php -->
@extends('app')  <!-- Correctly reference the app layout -->

@section('content')
<div>
    <h1>Books List</h1>

    <!-- Display flash message after deletion -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Format</th>
                <th>Number Of Pages</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->format }}</td>
                    <th>{{ $book->number_of_pages }}</th>
                    <td>{{ date('m/d/Y',strtotime($book->release_date)) }}</td>
                    <td>
                        <!-- Delete button that calls deleteBook method on click -->
                        <button type="button" class="btn btn-danger" wire:click="deleteBook({{ $book->id }})">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if(session()->has('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@endsection