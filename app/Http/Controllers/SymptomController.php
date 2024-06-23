<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::all();
        return view('symptoms.index', compact('symptoms'));
    }

    public function create()
    {
        return view('symptoms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:symptoms',
            'name' => 'required',
        ]);

        Symptom::create($request->all());

        return redirect()->route('symptoms.index');
    }

    public function show(Symptom $symptom)
    {
        return view('symptoms.show', compact('symptom'));
    }

    public function edit(Symptom $symptom)
    {
        return view('symptoms.edit', compact('symptom'));
    }

    public function update(Request $request, Symptom $symptom)
    {
        $request->validate([
            'code' => 'required|unique:symptoms,code,' . $symptom->id,
            'name' => 'required',
        ]);

        $symptom->update($request->all());

        return redirect()->route('symptoms.index');
    }

    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return redirect()->route('symptoms.index');
    }
}
