<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use \App\Modules\CommitteeDetails\Entities\Committee;

$factory->define(Committee::class, function (Faker $faker) {
    return [
        'position_control_id' => config('committeedetails.all_positions')[array_rand(config('committeedetails.all_positions'))],
        'group_control_id' => 389,
        'year' => getReaffiliationYear(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
