<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Position::insert([
            ['name' => 'Web Developer'],
            ['name' => 'IT Support'],
            ['name' => 'Admin'],
            ['name' => 'Human Resource (HR)'],
        ]);
    }
}