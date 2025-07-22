<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role ?? 'technicien';
        return view('dashboard', compact('role'));
    }
}

