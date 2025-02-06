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
        $authors = $this->apiService->getAuthors($token);
        
        return view('authors.index', compact('authors'));
    }

    public function show($id)
    {
        $token = Session::get('api_token');
        $author = $this->apiService->getAuthors($token)->firstWhere('id', $id);
        
        return view('authors.show', compact('author'));
    }
}
