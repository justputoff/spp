<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Menghitung total kelas dan siswa
        $totalClasses = Grade::count(); // Ganti dengan model yang sesuai
        $totalStudents = Student::count();

        // Data untuk chart
        $years = range(date('Y') - 5, date('Y') + 5);
        $studentCounts = $this->getStudentCountsByYear($years);

        return view('dashboard', compact('totalClasses', 'totalStudents', 'years', 'studentCounts'));
    }

    /**
     * Get student counts by year.
     */
    private function getStudentCountsByYear($years)
    {
        $studentCounts = Student::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
            ->whereIn(DB::raw('YEAR(created_at)'), $years)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->pluck('count', 'year')
            ->toArray();

        // Mengisi tahun yang tidak ada dengan nilai 0
        $studentCounts = array_replace(array_fill_keys($years, 0), $studentCounts);

        return array_values($studentCounts);
    }
}