<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = Faker\Factory::create();

        $limit = 50;

        for ($i = 0; $i < $limit; $i++){
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt(123456),
                'avatar' => $faker->imageUrl,
                'is_admin' => $faker->valid()->randomElement(['0','1'], $count = 1),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
