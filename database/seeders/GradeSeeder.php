<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            'KELAS SATU',
            'KELAS DUA',
            'KELAS TIGA',
            'KELAS EMPAT',
            'KELAS LIMA',
            'KELAS ENAM',
            'KELAS TUJUH',
            'KELAS DELAPAN',
            'KELAS SEMBILAN',
            'KELAS SEPULUH',
            'KELAS SEBELAS',
            'KELAS DUABELAS'
        ];

        foreach ($grades as $grade) {
            DB::table('grades')->insert([
                'name' => $grade,
                'teacher_id' => 1
            ]);
        }
    }
}
