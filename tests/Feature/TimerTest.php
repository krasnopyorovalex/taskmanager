<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TimerTest
 * @package Tests\Feature
 */
class TimerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function task_timer_start()
    {
        $task = create(Task::class);

        $this->post(route('timer.start', $task->timer))
            ->assertStatus(204);

        tap($task->timer->fresh(), function ($timer) {
            $this->assertEquals(0, $timer->total);
            $this->assertGreaterThan(0, $timer->job_start);
        });
    }

    /** @test */
    public function task_timer_calculate_stop_and_calculate_total()
    {
        $task = create(Task::class);

        $this->post(route('timer.start', $task->timer));

        sleep(1);

        $this->post(route('timer.stop', $task->timer))
            ->assertStatus(204);

        tap($task->timer->fresh(), function ($timer) {
            $this->assertEquals(1, $timer->total);
        });
    }
}
