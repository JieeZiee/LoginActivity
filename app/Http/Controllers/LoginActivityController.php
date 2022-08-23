<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mahfuz\LoginActivity\Models\LoginActivity;


class LoginActivityController extends Controller
{
    public function index()
    {
        $activities = LoginActivity::whereUserId(auth()->user()->id)->latest()->paginate(10);
        return view('login-activity::login-activity', compact('activities'));
    }
    
}
    
