<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $children = Child::with('stuntingCheck.symptoms')->get();
        return view('dashboard', compact('children'));
    }
}
