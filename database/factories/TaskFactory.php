<?php

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $status = array_random(Task::STATUSES);

    return [
        'name' => $faker->domainName,
        'body' => $faker->sentence,
        'status' => $status,
        'initiator_id' => function () {
            return factory(User::class)->create()->id;
        },
        'developer_id' => function () {
            return factory(User::class)->create()->id;
        },
        'closed_at' => ($status == "CLOSED"
            ? date('Y-m-d H:i:s')
            : null)
    ];
});
