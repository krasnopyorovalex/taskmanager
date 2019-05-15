<?php

namespace Tests\Feature;

use App\Task;
use App\Timer;
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

    public function setUp()
    {
        parent::setUp();

        $this->task = create(Task::class);
        $this->timer = $this->task->timer;
    }

    /** @test */
    public function task_always_has_a_timer()
    {
        $this->assertInstanceOf(Timer::class, $this->timer);

        $this->assertEquals(0, $this->timer->total);

        $this->assertEquals(0, $this->timer->job_start);
    }

    /** @test */
    public function task_timer_calculate_start()
    {
        $this->post(route('timer.start', $this->timer))
            ->assertStatus(204);

        tap($this->timer->fresh(), function ($timer) {
            $this->assertEquals(0, $timer->total);
            $this->assertGreaterThan(0, $timer->job_start);
        });
    }

    /** @test */
    public function task_timer_calculate_stop()
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
