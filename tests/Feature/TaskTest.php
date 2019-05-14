<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function auth_user_can_see_task()
    {
        $this->signIn();

        $task = create(Task::class, ['initiator_id' => auth()->id()]);

        $this->get(route('tasks.show', $task))
            ->assertSee($task->name);
    }

    /** @test */
    public function auth_user_can_see_all_tasks_list()
    {
        $this->signIn();

        $tasks = create(Task::class, ['initiator_id' => auth()->id()], 5);

        $this->get(route('tasks.index'))
            ->assertSee($tasks[0]->name)
            ->assertStatus(200);
    }
}
