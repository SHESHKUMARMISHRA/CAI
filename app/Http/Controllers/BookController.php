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
    public function index()
    {
        $token = Session::get('api_token');
        $response = $this->apiService->getBooks($token);
        // Assuming $response is an object and has an 'items' property
        $books = $response->items;  // Correctly accessing the 'items' property
        //dd($authors);
        return view('books-table', compact('books'));
    }

    public function create()
    {
        $token = Session::get('api_token');
        $response = $this->apiService->getAuthors($token);
        // Assuming $response is an object and has an 'items' property
        $authors = $response->items;  // Correctly accessing the 'items' property
        //dd($authors);
        return view('create-book', compact('authors'));
      
    }
    public function store(Request $request)
    {
       
        // Prepare the book data as per JSON format
        $data = [
            'author' => [
                'id' => $request->author_id
            ],
            'title' => $request->title,
            'release_date' => $request->release_date,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'format' => $request->format,
            'number_of_pages' => (int)($request->number_of_pages),
        ];

        $token = Session::get('api_token');
        $response = $this->apiService->addBook($token, $data);
        //dd($response);
        return redirect()->route('books.index')->with('success', 'Book added successfully!');

    }


    public function show($id)
    {
        $token = Session::get('api_token');
       // dd($id);
       
    }

    public function destroy($bookId)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized action.'], 401);
        }

        return $this->apiService->deleteBook($bookId, $token);        
    }
}
