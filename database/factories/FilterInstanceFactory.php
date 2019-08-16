<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Support\Filters\FilterInstance;
use Faker\Generator as Faker;

$factory->define(FilterInstance::class, function (Faker $faker) {
    return [
        'alias' => $faker->word,
        'name' => $faker->word,
        'settings' => $faker->randomElements(),
        'logic_id' => function() {
            return factory(\App\Support\Logic\Logic::class)->create()->id;
        },
        'logic_type' => $faker->randomElement(['all_true', 'any_true', 'all_false', 'any_false'])
    ];
});
