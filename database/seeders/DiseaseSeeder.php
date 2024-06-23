<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    public function run()
    {
        $diseases = [
            ['code' => 'P01', 'name' => 'Gizi Lebih', 'description' => 'Penggunaan protein, lemak atau kalori yang berlebihan juga dapat meningkatkan malnutrisi. Penderita mengalami kelebihan berat badan atau obesitas.', 'solution' => 'Atur porsi asupan gizi agar berat badannya tidak kian meningkat.'],
            ['code' => 'P02', 'name' => 'Marasmik-kwashiorkor', 'description' => 'Marasmik-kwashiorkor ialah tatanan lain dari malnutrisi bagi anak kecil, yang memadukan konotasi dan gejala marasmus dan kwashiorkor.', 'solution' => 'Penanganan medis secara intensif dan asupan gizi yang tepat.'],
            ['code' => 'P03', 'name' => 'Gizi Kurang', 'description' => 'Kekurangan nutrisi. Ini berarti bahwa anak kecil tidak bisa mendapatkan protein, kalori, vitamin atau mineral yang mereka butuhkan. Akibat dari asupan yang rendah ini adalah gizi buruk, pertumbuhan terhambat dan berat badan kurang.', 'solution' => 'Berikan ASI Eksklusif dan perbanyak asupan kalori'],
            ['code' => 'P04', 'name' => 'Kwashiorkor (Busung Lapar)', 'description' => 'Kwashiorkor adalah penyakit kekurangan gizi, terutama disebabkan oleh asupan protein yang tidak mencukupi. Berbeda dengan wasting yang mendapati penyusutan berat badan, kwashiorkor tidak. Malnutrisi yang disebabkan oleh kwashiorkor dapat menyebabkan pembengkakan pada tubuh anak kecil akibat penimbunan cairan (edema).', 'solution' => 'Diperlukan asupan nutrisi berupa kalori dan protein yang cukup'],
            ['code' => 'P05', 'name' => 'Marasmus', 'description' => 'Marasmus ialah situasi kurang gizi yang bermula oleh karena tiada tercukupi asupan energi harian. Maka sebaliknya, berguna untuk memenuhi keperluan stamina sepanjang waktu yang berguna membawa seluruh peran organ, sel, serta jaringan tubuh.', 'solution' => 'Pemberian nutrisi seperti vitamin, kasein, zat besi, kalsium, dan zinc'],

        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
};
