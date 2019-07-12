<?php

use App\Support\Event\Event;
use App\Support\Logic\Logic;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'for' => $faker->randomElement(['group', 'student']),
        'for_logic' => function () {
            return factory(Logic::class)->create()->id;
        },
        'start_date' => $faker->dateTime,
        'end_date' => $faker->dateTime,
    ];
});
