<?php

namespace App;

use App\Domain\Task\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TaskCreated::class
    ];
}
