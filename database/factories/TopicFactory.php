<?php

use Faker\Generator as Faker;



$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'bio' => $faker->paragraph,
        'question_count'=>1
    ];
});
