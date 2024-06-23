<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::all();
        return view('diseases.index', compact('diseases'));
    }

    public function create()
    {
        return view('diseases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:diseases',
            'name' => 'required',
            'description' => 'required',
            'solution' => 'required',
        ]);

        Disease::create($request->all());

        return redirect()->route('diseases.index');
    }

    public function show(Disease $disease)
    {
        return view('diseases.show', compact('disease'));
    }

    public function edit(Disease $disease)
    {
        return view('diseases.edit', compact('disease'));
    }

    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'code' => 'required|unique:diseases,code,' . $disease->id,
            'name' => 'required',
            'description' => 'required',
            'solution' => 'required',
        ]);

        $disease->update($request->all());

        return redirect()->route('diseases.index');
    }

    public function destroy(Disease $disease)
    {
        $disease->delete();
        return redirect()->route('diseases.index');
    }
}
