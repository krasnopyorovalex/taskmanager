<?php

declare(strict_types=1);

namespace App;

use App\Scopes\WithUsersByMyGroupsScope;
use Domain\Report\Filters\ReportFilter;
use Domain\Task\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
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
 * @property integer $group_id
 * @property string $deadline
 * @property string $created_at
 * @property string $updated_at
 * @property string $closed_at
 * @property string $uuid
 * @property-read Timer $timer
 * @property-read User $performer
 * @property-read User $author
 * @property-read File $files
 */
class Task extends Model
{
    use SoftDeletes, CommentableTrait;

    public $perPage = 12;

    protected $guarded = [];

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

        static::addGlobalScope(new WithUsersByMyGroupsScope);
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
     * Get the group record associated with the task.
     *
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class)->withTrashed();
    }

    /**
     * Get the user which created a task.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the user which take to perform a task.
     *
     * @return BelongsTo
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
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
     * Apply all relevant tasks by filters.
     *
     * @param Builder $query
     * @param ReportFilter $filter
     * @return Builder
     */
    public function scopeByFilter($query, ReportFilter $filter): Builder
    {
        return $filter->apply($query);
    }

    /**
     * @param Group $group
     * @return bool
     */
    public function hasGroup(Group $group): bool
    {
        return $group->id === $this->group->id;
    }
}
