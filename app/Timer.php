<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Timer
 * @package App
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $total
 * @property integer $job_start
 */
class Timer extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the task that owns the timer.
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
