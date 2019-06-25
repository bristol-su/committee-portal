<?php

use App\Support\Event\Event;
use App\Support\Logic\Logic;
use App\Support\Module\ModuleInstance\ModuleInstance;
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

$factory->define(ModuleInstance::class, function (Faker $faker) {
    return [
        'alias' => $faker->word,
        'event_id' => function () {
            return factory(Event::class)->create()->id;
        },
        'name' => $faker->word,
        'description' => $faker->text,
        'active' => function () {
            return factory(Logic::class)->create()->id;
        },
        'visible' => function () {
            return factory(Logic::class)->create()->id;
        },
        'mandatory' => function () {
            return factory(Logic::class)->create()->id;
        },
        'complete' => $faker->word
    ];
});
