<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Support\Activity\Activity;
use App\Support\Completion\EventStore;
use App\Support\ModuleInstance\ModuleInstance;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventStore::class, function (Faker $faker) {
    return [
        'module_instance_id' => function() {
            return factory(ModuleInstance::class)->create()->id;
        },
        'activity_id' => function() {
            return factory(Activity::class)->create()->id;
        },
        'event' => 'EventClass',
        'keywords' => ['foo' => 'bar'],
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'group_id' => null,
        'role_id' => null
    ];
});
