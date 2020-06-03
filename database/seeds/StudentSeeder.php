<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('students')->insert([
                'registration_number' => $faker->unique()->randomNumber(),
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'username' => $faker->unique()->userName,
                'password' => @$faker->password,
                'classroom_id' => rand(7, 13),
                'program_id' => rand(1, 4),
            ]);
        }
    }
}
