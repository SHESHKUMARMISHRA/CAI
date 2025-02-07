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
        return view('auth.login'); // Use correct path
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->apiService->login($credentials['email'], $credentials['password']);
        
        //dd($token);
        // Store token in session
        Session::put('api_token', $token['token_key']);

        return redirect()->route('authors.index');
    }

    public function logout(Request $request)
    {
        // Perform the logout
        Session::flush();

        // Redirect to login or any other page
        return redirect()->route('auth.login');  // Adjust as necessary
    }
}
