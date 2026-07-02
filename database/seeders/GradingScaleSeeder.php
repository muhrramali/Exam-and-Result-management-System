<?php

namespace Database\Seeders;

use App\Models\GradingScale;
use Illuminate\Database\Seeder;

class GradingScaleSeeder extends Seeder
{
    public function run(): void
    {
        GradingScale::insert([
            ['Grade_Letter' => 'A+', 'Min_Percent' => 90.00, 'Max_Percent' => 100.00, 'Grade_Point' => 4.00],
            ['Grade_Letter' => 'A',  'Min_Percent' => 80.00, 'Max_Percent' => 89.99, 'Grade_Point' => 3.70],
            ['Grade_Letter' => 'B+', 'Min_Percent' => 70.00, 'Max_Percent' => 79.99, 'Grade_Point' => 3.30],
            ['Grade_Letter' => 'B',  'Min_Percent' => 60.00, 'Max_Percent' => 69.99, 'Grade_Point' => 3.00],
            ['Grade_Letter' => 'C+', 'Min_Percent' => 50.00, 'Max_Percent' => 59.99, 'Grade_Point' => 2.30],
            ['Grade_Letter' => 'C',  'Min_Percent' => 40.00, 'Max_Percent' => 49.99, 'Grade_Point' => 2.00],
            ['Grade_Letter' => 'D',  'Min_Percent' => 33.00, 'Max_Percent' => 39.99, 'Grade_Point' => 1.00],
            ['Grade_Letter' => 'F',  'Min_Percent' => 0.00,  'Max_Percent' => 32.99, 'Grade_Point' => 0.00],
        ]);
    }
}