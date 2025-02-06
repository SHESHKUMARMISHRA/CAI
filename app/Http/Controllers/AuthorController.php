<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $token = Session::get('api_token');
        $response = $this->apiService->getAuthors($token);
        // Assuming $response is an object and has an 'items' property
        $authors = $response->items;  // Correctly accessing the 'items' property
        //dd($authors);
        return view('livewire.authors-table', compact('authors'));
    }

    public function show($id)
    {
        $token = Session::get('api_token');
        $authors = $this->apiService->getAuthors($token);

        // Convert the object to an array
        $authorsArray = json_decode(json_encode($authors->items), true);

        // Use array functions if necessary, or create a collection from it
        $author = collect($authorsArray)->firstWhere('id', $id);

        //dd($author);
        return view('livewire.profile', compact('author'));
    }

    
}
