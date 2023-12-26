<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $userDetail = Auth::user();
        return view('admin', compact('userDetail'));
    }
}
