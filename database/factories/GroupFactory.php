<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, static function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});
