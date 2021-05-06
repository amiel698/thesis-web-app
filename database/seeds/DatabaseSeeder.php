<?php

use App\StudentRecords;
use App\Students;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,12) as $index){
            $first_name = $faker->firstName;
            $last_name = $faker->lastName;
            $email = $first_name[0].$last_name[0].$last_name.'@g.com';

            User::create([
                'first_name' =>$first_name,
                'last_name' =>$last_name,
                'email' => $email,
                'password' => bcrypt('password'),
                'created_at' => $faker->dateTimeBetween('-12 month', '+1 month'),
                'user_type' => $faker->unique(true)->numberBetween(1,2)
            ]);
        }


        // $this->call(UserSeeder::class);
    }
}
