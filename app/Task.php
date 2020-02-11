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
 * @property-read User $performer
 * @property-read User $author
 */
class Task extends Model
{
    use SoftDeletes, CommentableTrait;

    public $perPage = 12;

    protected $guarded = [];

    protected $with = ['timer'];

    protected $dates = [
        'deadline',
        'closed_at'
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
}
