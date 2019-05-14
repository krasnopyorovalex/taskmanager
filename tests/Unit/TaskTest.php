<?php

namespace Tests\Unit;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function create_new_task()
    {
        $task = create(Task::class);

        $this->assertDatabaseHas('tasks', ['body' => $task->body]);

    }
}
