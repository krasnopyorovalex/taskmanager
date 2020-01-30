<?php

namespace Tests\Feature;

use App\Task;
use App\Timer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function auth_user_can_see_task()
    {
        $task = $this->createTask();

        $this->get(route('tasks.show', $task))
            ->assertSee($task->name);
    }

    /** @test */
    public function auth_user_can_see_all_tasks_list()
    {
        $tasks = create(Task::class, ['author_id' => auth()->id()], 5);

        $this->get(route('tasks.index'))
            ->assertSee($tasks[0]->name)
            ->assertStatus(200);
    }

    /** @test */
    public function task_always_has_a_timer()
    {
        $task = $this->createTask()->fresh();

        $this->assertInstanceOf(Timer::class, $task->timer);

        $this->assertDatabaseHas('timers', ['task_id' => $task->id]);

        $this->assertEquals(0, $task->timer->total);

        $this->assertEquals(0, $task->timer->job_start);
    }

    /**
     * @return mixed
     */
    private function createTask()
    {
        return create(Task::class, ['author_id' => auth()->id()]);
    }
}
