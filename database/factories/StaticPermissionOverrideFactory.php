<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Support\Module\Permissions\StaticPermissionOverride as StaticPermissionOverrideAlias;
use Faker\Generator as Faker;

$factory->define(StaticPermissionOverrideAlias::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        },
        'permission' => $faker->word,
        'result' => $faker->boolean
    ];
});
