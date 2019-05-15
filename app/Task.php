<?php

namespace App;

use App\Domain\Task\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property string $status
 * @property integer $initiator_id
 * @property integer $developer_id
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 * @property string $closed_at
 */
class Task extends Model
{
    public const STATUSES = [
        'NEW',
        'IN_WORK',
        'PAUSED',
        'COMPLETED',
        'RETURNED',
        'CLOSED'
    ];

    public const LIMIT_TASKS = 25;

    protected $guarded = ['id'];

    protected $with = ['initiator', 'developer', 'timer'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TaskCreated::class
    ];

    /**
     * Get the timer record associated with the task.
     */
    public function timer()
    {
        return $this->hasOne('App\Timer');
    }

    /**
     * Get the user which created a task.
     */
    public function initiator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user which take to perform a task.
     */
    public function developer()
    {
        return $this->belongsTo('App\User');
    }
}
