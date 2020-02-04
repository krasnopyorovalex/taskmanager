<?php

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, static function (Faker $faker) {

    $statuses = [
        'NEW',
        'IN_WORK',
        'PAUSED',
        'COMPLETED',
        'CLOSED'
    ];
    $key = array_rand($statuses);

    $status = $statuses[$key];

    $closedAt = $status === 'CLOSED'
        ? date('Y-m-d H:i:s')
        : null;

    return [
        'name' => $faker->domainName,
        'body' => $faker->paragraph(random_int(2,5)),
        'status' => $status,
        'deadline' => $status !== 'CLOSED'
            ? date('Y-'. random_int(date('m'), 12) .'-'. random_int(1, 28))
            : $closedAt,
        'author_id' => static function () {
            return factory(User::class)->create(['is_admin' => false])->id;
        },
        'performer_id' => static function () {
            return factory(User::class)->create(['is_admin' => false])->id;
        },
        'closed_at' => $closedAt
    ];
});
