<?php

namespace Tests\Feature;

use App\Task;
use App\Timer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    private $task;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();

        $this->task = create(Task::class, ['initiator_id' => auth()->id()]);
    }

    /** @test */
    public function auth_user_can_see_task()
    {
        $this->get(route('tasks.show', $this->task))
            ->assertSee($this->task->name);
    }

    /** @test */
    public function auth_user_can_see_all_tasks_list()
    {
        $tasks = create(Task::class, ['initiator_id' => auth()->id()], 5);

        $this->get(route('tasks.index'))
            ->assertSee($tasks[0]->name)
            ->assertStatus(200);
    }

    /** @test */
    public function task_always_has_a_timer()
    {
        $this->assertInstanceOf(Timer::class, $this->task->timer);

        $this->assertDatabaseHas('timers', ['task_id' => $this->task->id]);

        $this->assertEquals(0, $this->task->timer->total);

        $this->assertEquals(0, $this->task->timer->job_start);
    }
}
