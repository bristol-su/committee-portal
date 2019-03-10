<?php

use Faker\Generator as Faker;

$factory->define(\App\Modules\TierSelection\Entities\Tier::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'filename' => 'storage/images/'.$faker->image('public/storage/images', 640, 480, null, false)
    ];
});
