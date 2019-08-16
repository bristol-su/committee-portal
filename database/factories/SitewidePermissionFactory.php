<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Support\Logic\Logic;
use App\Support\Permissions\SitewidePermission;
use Faker\Generator as Faker;

$factory->define(SitewidePermission::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        },
        'permission' => $faker->word,
        'logic_id' => function() {
            return factory(Logic::class)->create();
        }
    ];
});
