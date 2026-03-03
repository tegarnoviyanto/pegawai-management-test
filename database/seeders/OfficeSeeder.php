<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        Office::insert([
            ['name' => 'Surakarta (Solo)'],
            ['name' => 'Sukoharjo'],
            ['name' => 'Karanganyar'],
            ['name' => 'Boyolali'],
            ['name' => 'Wonogiri'],
            ['name' => 'Klaten'],
            ['name' => 'Semarang'],
            ['name' => 'Salatiga'],
        ]);
    }
}