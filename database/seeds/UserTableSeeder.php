<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [];

        $faker = Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\es_ES\Person($faker));

        for($i=0; $i<100; $i++){
            array_push($users,
                [
                    'name' => $faker->firstName(),
                    'lastname' => $faker->lastName(),
                    'email' => $faker->unique()->freeEmail(),
                    'password' => $faker->password(),
                    'role' => 0
                ]);
        }

        array_push($users, [
            'name' => 'admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'role' => 1
        ]);

        DB::table('user')->insert($users);
    }
}
