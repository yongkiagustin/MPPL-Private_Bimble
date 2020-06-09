<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
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

        DB::table('staff')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        for ($i = 0; $i < $limit; $i++) {
            DB::table('staff')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'username' => $faker->userName,
                'password' => Hash::make('password1'),
            ]);
        }
    }
}
