<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\StuntingCheck;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function createStepOne(Request $request)
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
        ]);

        $child = Child::create($validatedData);

        $request->session()->put('child_id', $child->id);

        return redirect()->route('children.create.step.two');
    }

    public function createStepTwo(Request $request)
    {
        $child_id = $request->session()->get('child_id');

        if (!$child_id) {
            return redirect()->route('children.create.step.one');
        }

        return view('children.create-step-two');
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_poor_family' => 'required|boolean',
        ]);

        $child_id = $request->session()->get('child_id');

        if (!$child_id) {
            return redirect()->route('children.create.step.one');
        }

        $stuntingCheck = new StuntingCheck();
        $stuntingCheck->child_id = $child_id;
        $stuntingCheck->height = $validatedData['height'];
        $stuntingCheck->weight = $validatedData['weight'];
        $stuntingCheck->is_poor_family = $validatedData['is_poor_family'];

        // Logika penilaian stunting
        $stuntingCheck->stunting_status = $this->checkStuntingStatus($validatedData['height'], $validatedData['weight']);

        $stuntingCheck->save();

        return redirect()->route('children.index');
    }

    public function index()
    {
        $children = Child::with('stuntingCheck')->get();

        return view('children.index', compact('children'));
    }

    private function checkStuntingStatus($height, $weight)
    {
        // Logika sederhana untuk penilaian stunting
        // Ideal values dapat disesuaikan dengan standar WHO atau lainnya
        $idealHeight = 75; // contoh ideal height
        $idealWeight = 10; // contoh ideal weight

        if ($height < $idealHeight || $weight < $idealWeight) {
            return 'stunting';
        }

        return 'normal';
    }
}
