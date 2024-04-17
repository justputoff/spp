<?php

namespace App\Http\Controllers;

use App\Models\SppStudent;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SppStudent::all();
        return view('report.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generateDummyData()
    {
        Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_071553_create_student_parents_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_30_172130_create_students_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_045930_create_spp_students_table.php');
        Artisan::call('db:seed --class=UserSeeder');
        $faker = Faker::create('id_ID'); // Atur locale ke Indonesia
        $grades = range(1, 12); // Grade IDs
        $parentCount = 60; // Jumlah parent yang akan dibuat
        $studentCount = 60; // Jumlah student yang akan dibuat
        $parentIds = [];

        // Generate Parents and Users
        for ($i = 0; $i < $parentCount; $i++) {
            $parentName = $faker->firstNameFemale . ' ' . $faker->lastName; // Nama lengkap orang tua perempuan
            $user = User::create([
                'name' => $parentName,
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password123'), // Atur password yang sesuai
                'role' => 'PARENT',
            ]);

            $parentPhone = '08' . mt_rand(1000000000, 9999999999); // Nomor telepon acak

            $parent = StudentParent::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $parentPhone,
            ]);

            $parentIds[] = $parent->id;
        }

        // Generate Students
        foreach ($parentIds as $parentId) {
            $gradeIndex = array_rand($grades); // Pilih grade secara acak untuk siswa
            $studentName = $faker->firstNameFemale . ' ' . $faker->lastName; // Nama lengkap siswa perempuan
        
            $student = Student::create([
                'grade_id' => $grades[$gradeIndex],
                'student_parent_id' => $parentId, // Gunakan ID parent yang sesuai
                'ta_student_id' => 1,
                'nis' => rand(100000, 999999),
                'nisn' => rand(1000000000, 9999999999),
                'nik' => rand(1000000000, 9999999999),
                'name' => $studentName,
            ]);
        }
        dd('sukses');
        return response()->json(['message' => 'Dummy data generated successfully']);
    }
}
 