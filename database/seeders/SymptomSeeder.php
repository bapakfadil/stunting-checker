<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    public function run()
    {
        $symptoms = [
            ['code' => 'G001', 'name' => 'Beran badan menurun'],
            ['code' => 'G002', 'name' => 'Mudah menangis'],
            ['code' => 'G003', 'name' => 'Proporsi tubuh cenderung normal namun balita terlihat lebih muda/kecil untuk usianya'],
            ['code' => 'G004', 'name' => 'Otot-otot melemah'],
            ['code' => 'G005', 'name' => 'Balita akan menjadi lebih pendiam dan tidak ingin berbuat banyak kontak mata dengan orang sekeliling.'],
            ['code' => 'G006', 'name' => 'Diare kronis'],
            ['code' => 'G007', 'name' => 'Infeksi berulang'],
            ['code' => 'G008', 'name' => 'Terhambatnya perkembangan intelektual, kecerdasan'],
            ['code' => 'G009', 'name' => 'Pertumbuhan tulang melambat'],
            ['code' => 'G010', 'name' => 'Fokus ingatan terganggu'],
            ['code' => 'G011', 'name' => 'Rupa balita kian muda dari anak seumurannya'],
            ['code' => 'G012', 'name' => 'Pertumbuhan gigi melambat'],
            ['code' => 'G013', 'name' => 'Rambut rapuh dan mudah rontok'],
            ['code' => 'G014', 'name' => 'Kulit tampak keriput'],
            ['code' => 'G015', 'name' => 'Pusing'],
            ['code' => 'G016', 'name' => 'Kehilangan selera makan'],
            ['code' => 'G017', 'name' => 'Menurunnya perkembangan kognitif'],
            ['code' => 'G018', 'name' => 'Kelelahan parah'],
            ['code' => 'G019', 'name' => 'Edema (pembengkakan) di bagian tungkai, kaki, lengan, tangan, serta muka (Cairan)'],
            ['code' => 'G020', 'name' => 'Terhalangnya struktur imun tubuh, hingga muncul peradangan'],
            ['code' => 'G021', 'name' => 'Bintik dan bersisik di tubuh'],
            ['code' => 'G022', 'name' => 'Tanda jari membekas pada kulit setelah disentuh'],
            ['code' => 'G023', 'name' => 'Badan tampak semakin kurus'],
            ['code' => 'G024', 'name' => 'Kelebihan berat badan'],
            ['code' => 'G025', 'name' => 'Kurangnya nafsu makan'],
            ['code' => 'G026', 'name' => 'Kekebalan tubuh melemah'],
            ['code' => 'G027', 'name' => 'Rambut dan kulit kering'],
            ['code' => 'G028', 'name' => 'Obesitas'],
            ['code' => 'G029', 'name' => 'Merasa kelaparan'],
            ['code' => 'G030', 'name' => 'Wajah tampak tua'],
            ['code' => 'G031', 'name' => 'Mudah sakit dan butuh waktu lama tuk sembuh'],
            ['code' => 'G032', 'name' => 'Perut semakin membuncit'],
            ['code' => 'G033', 'name' => 'Sanitasi yang buruk'],
            ['code' => 'G034', 'name' => 'Tubuh pendek dari seusianya'],
            ['code' => 'G035', 'name' => 'Lahir prematur'],
            ['code' => 'G036', 'name' => 'Tubuh gemuk'],
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create($symptom);
        }
    }
};
