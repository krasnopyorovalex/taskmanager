<?php

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, static function (Faker $faker) {

    $status = array_rand(Task::STATUSES_LABELS);

    $closedAt = $status === 'CLOSED'
        ? date('Y-m-d H:i:s')
        : null;

    return [
        'name' => $faker->domainName,
        'body' => $faker->sentence,
        'status' => $status,
        'deadline' => $status !== 'CLOSED'
            ? date('Y-'. random_int(date('m'), 12) .'-'. random_int(1, 28) .' H:i:s')
            : $closedAt,
        'author_id' => static function () {
            return factory(User::class)->create()->id;
        },
        'performer_id' => static function () {
            return factory(User::class)->create()->id;
        },
        'closed_at' => $closedAt
    ];
});
