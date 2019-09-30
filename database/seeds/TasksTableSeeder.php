<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        factory(App\Task::class, 25)->create()->each(static function ($task) {
            $task->timer->total = random_int(1, 5000);
            $task->timer->save();
        });
    }
}
