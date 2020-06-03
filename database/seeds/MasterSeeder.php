<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert(
            [
                ['name' => 'Program Emas Unggulan'],
                ['name' => 'Program Garansi Lolos PTN'],
                ['name' => 'Program Regular SMA'],
                ['name' => 'Program Regular SMP'],
                ['name' => 'Program Regular SD'],
                ['name' => 'Program Privat'],
            ]
        );

        DB::table('classrooms')->insert(
            [
                ['name' => 'SD Kelas 1'],
                ['name' => 'SD Kelas 2'],
                ['name' => 'SD Kelas 3'],
                ['name' => 'SD Kelas 4'],
                ['name' => 'SD Kelas 5'],
                ['name' => 'SD Kelas 6'],
                ['name' => 'SMP Kelas 7'],
                ['name' => 'SMP Kelas 8'],
                ['name' => 'SMP Kelas 9'],
                ['name' => 'SMA Kelas 10'],
                ['name' => 'SMA Kelas 11'],
                ['name' => 'SMA Kelas 12'],
                ['name' => 'Alumni'],
            ]
        );
    }
}
