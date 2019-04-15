<?php

use Carbon\Carbon;
use App\PositionSetting;
use Faker\Generator as Faker;

$factory->define(PositionSetting::class, function(Faker $faker) {
    return [
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
