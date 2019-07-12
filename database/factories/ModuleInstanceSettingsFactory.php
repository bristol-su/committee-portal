<?php

use Faker\Generator as Faker;

$factory->define(\App\Support\Module\Settings\ModuleInstanceSettings::class, function (Faker $faker) {
    return [
        'settings' => [
            'foo' => $faker->word,
            'bar' => $faker->word,
            'baz' => $faker->word,
        ]
    ];
});
