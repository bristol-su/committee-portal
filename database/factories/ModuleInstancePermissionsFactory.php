<?php

use App\Support\Permissions\ModuleInstancePermissions;
use Faker\Generator as Faker;

$factory->define(ModuleInstancePermissions::class, function (Faker $faker) {
    $logic = factory(\App\Support\Logic\Logic::class)->create();
    return [
        'participant_permissions' => [
            'foo' => $logic->id,
            'bar' => $logic->id,
            'baz' => $logic->id,
        ],
        'admin_permissions' => [
            'foo' => $logic->id,
            'bar' => $logic->id,
            'baz' => $logic->id,
        ]
    ];
});
