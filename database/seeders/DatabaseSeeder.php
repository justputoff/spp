<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menghapus semua folder dalam path tertentu
        $path = 'public/assets/image'; // Path yang ingin dihapus
        $this->deleteAllFiles($path);

        // Refresh migration
        Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_30_172130_create_students_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_045022_create_grades_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_045930_create_spp_students_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_063250_create_ta_students_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_01_31_071553_create_student_parents_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_04_16_184650_create_student_fees_table.php');
        Artisan::call('migrate:refresh --path=/database/migrations/2024_04_17_120931_create_transactions_table.php');

        // Menjalankan seeder
        $this->call([
            UserSeeder::class,
            GradeSeeder::class,
            ParentSeeder::class,
            StudentFeeSeeder::class,
            TaSeeder::class,
        ]);
    }

    /**
     * Menghapus semua folder dalam suatu path.
     */
    public function deleteAllFiles($path)
    {
        // Mengecek apakah path ada
        if (Storage::exists($path)) {
            // Mengambil semua file dalam path
            $files = Storage::files($path);
            
            // Menghapus semua file
            foreach ($files as $file) {
                Storage::delete($file);
            }
    
            // Memeriksa apakah semua file berhasil dihapus
            if (empty(Storage::files($path))) {
                echo "Semua file dalam path berhasil dihapus.\n";
            } else {
                echo "Gagal menghapus file dalam path.\n";
            }
        } else {
            echo "Path tidak ditemukan.\n";
        }
    }
}
