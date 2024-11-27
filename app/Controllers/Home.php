<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        // Check if the session exists; if so, redirect to the dashboard
        if (session()->has('user')) {
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        // If no session exists, show the login page
        return view('auth/login', ['title' => 'Login']);
    }
}
