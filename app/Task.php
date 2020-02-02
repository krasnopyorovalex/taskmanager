<?php

declare(strict_types=1);

namespace App;

use Domain\Task\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Task
 *
 * @package App
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
 * @property string $uuid
 * @property-read Timer $timer
 */
class Task extends Model
{
    use SoftDeletes, CommentableTrait;

    public const STATUSES_LABELS = [
        'NEW' => 'новый',
        'IN_WORK' => 'в работе',
        'PAUSED' => 'приостановлено',
        'COMPLETED' => 'выполнено',
        'CLOSED' => 'закрыто'
    ];

    public $perPage = 10;

    protected $guarded = [];

    protected $with = ['timer'];

    protected $dates = [
        'deadline'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

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
     * Get the files for the task.
     *
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * @todo refactor method
     *
     * @param $query
     * @return mixed
     */
    public function scopeActual($query)
    {
        return $query->whereIn('status', ['NEW', 'IN_WORK', 'PAUSED']);
    }

    /**
     * @todo refactor method
     *
     * @return bool
     */
    public function inWork(): bool
    {
        return $this->status === 'IN_WORK';
    }

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline
            ? $this->deadline->formatLocalized('%d %b %Y')
            : 'Не задано';
    }

    /**
     * @return mixed
     */
    public function getLabelStatusAttribute()
    {
        return self::STATUSES_LABELS[$this->status];
    }

    /**
     * @todo refactor method
     *
     * @return string
     */
    public function getIconAttribute(): string
    {
        return $this->status === 'IN_WORK' ? 'icon-pause' : 'icon-play';
    }
}
