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
        $path = 'public'; // Path yang ingin dihapus
        $this->deleteAllFiles($path);

        // Refresh migration
        Artisan::call('migrate:fresh');

        // Menjalankan seeder
        $this->call([
            UserSeeder::class,
            TaSeeder::class,
            GradeSeeder::class,
            ParentSeeder::class,
            StudentFeeSeeder::class,
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
