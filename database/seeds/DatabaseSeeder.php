<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $factory->define(App\Topic::class, function (Faker $faker) {
            return [
                'name' => $faker->word,
                'bio' => $faker->paragraph,
                'question_count'=>1,
            ];
        });// $this->call(UsersTableSeeder::class);
    }
}
