<?php

declare(strict_types=1);

namespace App;

use App\Domain\Task\Events\TaskCreated;
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
 * @property integer $initiator_id
 * @property integer $developer_id
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 * @property string $closed_at
 */
class Task extends Model
{
    public const STATUSES_LABELS = [
        'NEW' => 'Новый',
        'IN_WORK' => 'В работе',
        'PAUSED' => 'Приостановлено',
        'COMPLETED' => 'Выполнено',
        'RETURNED' => 'Возврат',
        'CLOSED' => 'Закрыто'
    ];

    public $perPage = 25;

    protected $guarded = [];

    protected $with = ['initiator', 'developer', 'timer'];

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
    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user which take to perform a task.
     *
     * @return BelongsTo
     */
    public function developer(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
     * @return mixed|string
     */
    public function getLabelStatusAttribute()
    {
        return self::STATUSES_LABELS[$this->status] ?? 'Пропишите метку для статуса';
    }
}
