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

    private $task;
    private $timer;

    public function setUp(): void
    {
        parent::setUp();

        $this->task = create(Task::class);
        $this->timer = $this->task->timer;
    }

    /** @test */
    public function task_timer_start()
    {
        $this->post(route('timer.start', $this->timer))
            ->assertStatus(204);

        tap($this->timer->fresh(), function ($timer) {
            $this->assertEquals(0, $timer->total);
            $this->assertGreaterThan(0, $timer->job_start);
        });
    }

    /** @test */
    public function task_timer_calculate_stop_and_calculate_total()
    {
        $this->post(route('timer.start', $this->timer));

        sleep(1);

        $this->post(route('timer.stop', $this->timer))
            ->assertStatus(204);

        tap($this->timer->fresh(), function ($timer) {
            $this->assertEquals(1, $timer->total);
        });
    }
}
