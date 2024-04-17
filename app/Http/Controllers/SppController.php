<?php

namespace App\Http\Controllers;

use App\Models\SppStudent;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\StudentParent;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bulans = [
            'JANUARI',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'DESEMBER',
        ];
        $students = Student::all();
        $data = SppStudent::all();
        return view('spp.index', [
            'data' => $data,
            'students' => $students,
            'bulans' => $bulans,
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
        $spp = StudentFee::latest()->first(); // Mendapatkan informasi fee terbaru

        $students = Student::all(); // Mendapatkan semua data siswa

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Kelompokkan siswa berdasarkan parent mereka (student_parent_id)
        $studentsByParent = $students->groupBy('student_parent_id');

        foreach ($studentsByParent as $parentId => $groupedStudents) {
            $parent = StudentParent::find($parentId); // Dapatkan objek parent berdasarkan ID

            // Hitung jumlah siswa dalam kelompok ini
            $numberOfStudents = $groupedStudents->count();

            // Tentukan harga yang akan digunakan (dengan atau tanpa diskon)
            $price = $numberOfStudents > 1 ? ($spp->price * 0.9) : $spp->price;

            // Buat record SppStudent untuk setiap siswa dalam kelompok
            foreach ($groupedStudents as $student) {
                SppStudent::create([
                    'student_id' => $student->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'price' => $price,
                ]);
            }
        }
        return back()->with('success' , 'SUKSES');
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
        $item = SppStudent::find($id);
        return view('spp.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $item = SppStudent::find($id);
        $item->update($data);
        return redirect()->route('spp.index')->with('success', 'SUKSES UPDATE DATA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
