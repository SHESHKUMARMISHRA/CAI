<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showLogin()
    {
        return view('livewire.auth.login'); // Use correct path
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->apiService->login($credentials['email'], $credentials['password']);
        
        //dd($token);
        // Store token in session
        Session::put('api_token', $token->access_token);

        return redirect()->route('authors.index');
    }
}
