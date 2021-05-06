<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\StudentRecords;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,100) as $index){
        StudentRecords::create([
            // 'student_id' => User::where('user_type',1)->get()->random()->id,
            'student_id' => 7,
            'grading' => $faker->unique(true)->randomElement(['1','2','3','4']),
            'difficulty' => $faker->unique(true)->randomElement(['easy', 'medium', 'hard']),
            'score' => $faker->unique(true)->numberBetween(1,20),
            'created_at' => $faker->dateTimeBetween('-12 month', '+1 month')

            ]);
        }
    }
}
