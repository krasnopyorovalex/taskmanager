<?php

declare(strict_types=1);

namespace App;

use Domain\Task\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Task
 * @package App
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property string $status
 * @property integer $author_id
 * @property integer $performer_id
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 * @property string $closed_at
 */
class Task extends Model
{
    public const STATUSES_LABELS = [
        'NEW' => 'новый',
        'IN_WORK' => 'в работе',
        'PAUSED' => 'приостановлено',
        'COMPLETED' => 'выполнено',
        'CLOSED' => 'закрыто'
    ];

    public $perPage = 10;

    protected $guarded = [];

    protected $with = ['author', 'performer', 'timer'];

    protected $dates = [
        'deadline'
    ];

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
     *
     * @return HasOne
     */
    public function timer(): HasOne
    {
        return $this->hasOne(Timer::class);
    }

    /**
     * Get the user which created a task.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user which take to perform a task.
     *
     * @return BelongsTo
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActual($query)
    {
        return $query->whereIn('status', ['NEW', 'IN_WORK', 'PAUSED']);
    }

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline
            ? $this->deadline->formatLocalized('%d %b %Y')
            : '';
    }

    /**
     * @return mixed
     */
    public function getLabelStatusAttribute()
    {
        return self::STATUSES_LABELS[$this->status];
    }

    /**
     * @return string
     */
    public function getIconAttribute(): string
    {
        return $this->status === 'IN_WORK' ? 'icon-pause' : 'icon-play';
    }
}
