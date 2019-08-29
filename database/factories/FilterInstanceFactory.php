<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Support\Filters\FilterInstance;
use Faker\Generator as Faker;

$factory->define(FilterInstance::class, function (Faker $faker) {
    return [
        'alias' => $faker->word,
        'name' => $faker->word,
        'settings' => $faker->randomElements(),
    ];
});
