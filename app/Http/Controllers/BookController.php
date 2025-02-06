<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
   

    public function show($id)
    {
        $token = Session::get('api_token');
        $response = $this->apiService->getBooks($token);
        // Assuming $response is an object and has an 'items' property
        $books = $response->items;  // Correctly accessing the 'items' property
        //dd($books);
        return view('livewire.books-table', compact('books'));
    }
}
