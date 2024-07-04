<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\StuntingCheck;
use App\Models\Symptom;
use App\Models\Disease;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            return redirect()->route('children.createStepOne')->withErrors(['message' => 'Data anak tidak ditemukan. Silakan lengkapi Langkah Pertama.']);
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
            return redirect()->route('children.createStepOne')->withErrors(['message' => 'Data anak tidak ditemukan. Silakan lengkapi Langkah Pertama.']);
        }

        $stuntingCheck = new StuntingCheck();
        $stuntingCheck->child_id = $child_id;
        $stuntingCheck->height = $validatedData['height'];
        $stuntingCheck->weight = $validatedData['weight'];
        $stuntingCheck->is_poor_family = $validatedData['is_poor_family'];
        $stuntingCheck->stunting_status = $this->calculateStuntingStatus($validatedData['symptoms']);
        $stuntingCheck->save();

        $stuntingCheck->symptoms()->attach($validatedData['symptoms']);

        return redirect()->route('dashboard')->with('success', 'Data anak berhasil dibuat.');
    }

    private function calculateStuntingStatus(array $symptoms)
    {
        $rules = [
            'Gizi Lebih' => [24, 28, 36],
            'Marasmik-kwashiorkor' => [23, 4, 5, 19, 26, 35],
            'Gizi Kurang' => [9, 18, 33, 31, 25, 11, 10, 3],
            'Kwashiokor' => [16, 14, 18, 6, 9, 19, 20, 2, 12, 21, 22, 32],
            'Marasmus' => [6, 7, 20, 9, 12, 13, 15, 27, 29, 23, 30, 1, 2, 34, 17]
        ];

        // Cek jika user hanya memasukkan 1 hingga 3 gejala
        if (count($symptoms) <= 3) {
            foreach ($rules as $status => $ruleSymptoms) {
                if (array_intersect($symptoms, $ruleSymptoms) === $symptoms) {
                    return $status;
                }
            }
            return 'Normal';
        }

        // Cek jika gejala user sesuai dengan salah satu aturan
        foreach ($rules as $status => $ruleSymptoms) {
            if (empty(array_diff($ruleSymptoms, $symptoms))) {
                return $status;
            }
        }

        // Jika tidak ada kecocokan dengan aturan
        return 'Hasil tidak ditemukan';
    }

    public function show($id)
    {
        $child = Child::with('stuntingCheck.symptoms')->findOrFail($id);
        $stuntingStatus = optional($child->stuntingCheck)->stunting_status;

        // Ambil data disease berdasarkan status stunting
        $disease = null;
        if ($stuntingStatus) {
            $disease = Disease::where('name', $stuntingStatus)->first();
        }

        // Hitung umur anak
        $dateOfBirth = Carbon::parse($child->date_of_birth);
        $age = $dateOfBirth->age;

        return view('children.show', compact('child', 'disease', 'age'));
    }

    public function edit($id)
    {
        $child = Child::findOrFail($id);
        $symptoms = Symptom::all();
        $latestStuntingCheck = StuntingCheck::where('child_id', $child->id)->latest()->first();

        return view('children.edit', compact('child', 'symptoms', 'latestStuntingCheck'));
    }


    public function update(Request $request, $id)
{
    // Validasi data untuk child
    $validatedChildData = $request->validate([
        'full_name' => 'required|string|max:255',
        'place_of_birth' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'father_name' => 'required|string|max:255',
        'mother_name' => 'required|string|max:255',
    ]);

    // Validasi data untuk stunting check
    $validatedStuntingCheckData = $request->validate([
        'height' => 'required|numeric',
        'weight' => 'required|numeric',
        'is_poor_family' => 'required|boolean',
        'symptoms' => 'required|array',
    ]);

    // Update data child
    $child = Child::findOrFail($id);
    $child->update($validatedChildData);

    // Update data stunting check
    $stuntingCheck = StuntingCheck::findOrFail($request->input('stunting_check_id'));
    $stuntingCheck->update([
        'height' => $validatedStuntingCheckData['height'],
        'weight' => $validatedStuntingCheckData['weight'],
        'is_poor_family' => $validatedStuntingCheckData['is_poor_family'],
        'stunting_status' => $this->calculateStuntingStatus($validatedStuntingCheckData['symptoms']),
    ]);

    // Sync symptoms
    $stuntingCheck->symptoms()->sync($validatedStuntingCheckData['symptoms']);

    return redirect()->route('dashboard')->with('success', 'Data anak berhasil diperbarui.');
}

}
