<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function showForm()
    {
        $symptoms = Symptom::all();
        return view('symptoms_form', compact('symptoms'));
    }

    public function diagnose(Request $request)
    {
        $inputSymptoms = $request->input('symptoms', []);
        $disease = $this->classifyDisease($inputSymptoms);

        return view('diagnosis_result', compact('disease'));
    }

    private function classifyDisease($inputSymptoms)
    {
        $rules = [
            'Gizi Lebih' => ['symptoms' => [1, 2, 3]],
            'Marasmik-kwashiorkor' => ['symptoms' => [4, 5, 6, 7, 8, 9]],
            // Tambahkan aturan lainnya sesuai jurnal
        ];

        foreach ($rules as $disease => $rule) {
            if (empty(array_diff($rule['symptoms'], $inputSymptoms))) {
                return $disease;
            }
        }

        return 'Tidak Diketahui';
    }
}
