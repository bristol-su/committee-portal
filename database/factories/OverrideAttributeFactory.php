<?php

use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use App\Support\Module\Registration\OverrideAttribute;
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

$factory->define(OverrideAttribute::class, function (Faker $faker) {
    return [
        'attributes' => [
            'one'  => $faker->word,
            'two' => $faker->word,
        ]
    ];
});
