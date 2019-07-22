<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Support\Event\Event;
use App\Support\EventStore\EventStore;
use App\Support\Module\ModuleInstance\ModuleInstance;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventStore::class, function (Faker $faker) {
    return [
        'module_instance_id' => function() {
            return factory(ModuleInstance::class)->create()->id;
        },
        'event_id' => function() {
            return factory(Event::class)->create()->id;
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