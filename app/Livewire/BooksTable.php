<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;  
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class BooksTable extends Component
{
    public $books= [];

    protected $apiService;
    public function __construct()
    {
        // Inject Guzzle Client into ApiService
        $this->apiService = new ApiService(new Client());
    }

    public function mount()
    {
        $token = Session::get('api_token');

        // Fetch books from API
        $this->books = $this->apiService->getBooks($token);
        
    }

    public function deleteBook($bookId)
    {
        // Find the book by ID and delete it
       
        //session()->flash('message', 'Book deleted successfully!');
    }
    public function render()
    {
        return view('livewire.books-table');
    }
}
