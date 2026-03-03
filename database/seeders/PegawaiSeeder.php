<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Position;
use App\Models\Office;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $positions = Position::pluck('id')->toArray();
        $offices   = Office::pluck('id')->toArray();

        $data = [
            ['Budi Santoso', '1995-03-12'],
            ['Andi Pratama', '1996-06-22'],
            ['Siti Aisyah', '1998-02-11'],
            ['Rizky Maulana', '1997-01-09'],
            ['Dewi Lestari', '1994-10-20'],
            ['Agus Setiawan', '1990-04-18'],
            ['Nina Kurniawati', '1993-07-05'],
            ['Raka Saputra', '1999-09-15'],
            ['Intan Permata', '1997-12-01'],
            ['Fajar Hidayat', '1992-08-23'],
            ['Rizal Firmansyah', '1994-05-14'],
            ['Wulan Sari', '1996-03-27'],
            ['Yoga Prabowo', '1995-11-02'],
            ['Putri Maharani', '1999-06-19'],
            ['Dimas Saputro', '1991-01-30'],
            ['Rina Aprilia', '1993-02-16'],
            ['Bayu Nugroho', '1990-09-09'],
            ['Ayu Rahmawati', '1998-04-25'],
            ['Hendra Wijaya', '1989-07-07'],
            ['Tika Puspitasari', '1997-10-10'],
        ];

        foreach ($data as $row) {
            Pegawai::create([
                'name' => $row[0],
                'position_id' => $positions[array_rand($positions)],
                'office_id' => $offices[array_rand($offices)],
                'tanggal_lahir' => $row[1],
                'cv' => null,
            ]);
        }
    }
}