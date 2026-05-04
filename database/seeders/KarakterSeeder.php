<?php

namespace Database\Seeders;

use App\Models\Karakter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KarakterSeeder extends Seeder
{
    public function run()
    {
        $folderPath = public_path('images');
            if (!File::exists($folderPath)) {
            $this->command->error("Folder tidak ditemukan di: " . $folderPath);
            return;
        }
        $files = File::files($folderPath);

        if (empty($files)) {
            $this->command->warn("Folder kosong, tidak ada gambar ditemukan!");
            return;
        }

        foreach ($files as $file) {
            $filename = $file->getFilename(); 
            $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
            
            // Memecah berdasarkan underscore
            $parts = explode('_', $nameWithoutExt);

            if (count($parts) >= 3) {
                // Ambil karakter pertama dari bagian pertama (contoh: 4 dari 4002)
                $diff = (int)substr($parts[0], 0, 1); 

                Karakter::create([
                    'difficulty'    => $diff,
                    'nama_karakter' => $parts[1],
                    'nama_anime'    => $parts[2],
                    'file_path'     => 'images/' . $filename,
                ]);
            }
        }
    }
}