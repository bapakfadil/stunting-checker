<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\StuntingCheck;
use App\Models\Symptom;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function createStepOne()
    {
        return view('children.create-step-one');
    }

    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            // 'is_poor_family' => 'required|boolean',
        ]);

        $child = Child::create($validatedData);

        $request->session()->put('child_id', $child->id);

        return redirect()->route('children.createStepTwo');
    }

    public function createStepTwo(Request $request)
    {
        $child_id = $request->session()->get('child_id');
        $symptoms = Symptom::all();

        if (!$child_id) {
            return redirect()->route('children.CreateStepOne');
        }

        return view('children.create-step-two', compact('symptoms'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_poor_family' => 'required|boolean',
            'symptoms' => 'required|array',
        ]);

        $child_id = $request->session()->get('child_id');

        if (!$child_id) {
            return redirect()->route('children.createStepOne');
        }

        $stuntingCheck = new StuntingCheck();
        $stuntingCheck->child_id = $child_id;
        $stuntingCheck->height = $validatedData['height'];
        $stuntingCheck->weight = $validatedData['weight'];
        $stuntingCheck->is_poor_family = $validatedData['is_poor_family'];
        $stuntingCheck->stunting_status = $this->calculateStuntingStatus($validatedData['symptoms']);
        $stuntingCheck->save();

        $stuntingCheck->symptoms()->attach($validatedData['symptoms']);

        return redirect()->route('dashboard');
    }

    private function calculateStuntingStatus($symptoms)
    {
        $rules = [
            'Gizi Lebih' => [24, 28, 36],
            'Marasmik-kwashiorkor' => [23, 4, 5, 19, 26, 35],
            'Gizi Kurang' => [9, 18, 33, 31, 25, 11, 10, 3],
            'Kwashiokor' => [16, 14, 18, 6, 9, 19, 20, 2, 12, 21, 22, 32],
            'Marasmus' => [6, 7, 20, 9, 12, 13, 15, 27, 29, 23, 30, 1, 2, 34, 17]
        ];

        foreach ($rules as $status => $ruleSymptoms) {
            if (empty(array_diff($ruleSymptoms, $symptoms))) {
                return $status;
            }
        }

        return 'Normal';
    }

    public function show($id)
    {
        $child = Child::with('stuntingCheck.symptoms')->findOrFail($id);
        return view('children.show', compact('child'));
    }

    public function edit($id)
    {
        $child = Child::findOrFail($id);
        return view('children.edit', compact('child'));
    }

    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $child->update($request->all());
        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();
        return redirect()->route('dashboard');
    }
}
