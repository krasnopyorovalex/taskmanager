<?php

declare(strict_types=1);

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * Class Comment
 *
 * @package App
 * @property integer $parent_id
 * @property integer $task_id
 * @property integer $user_id
 * @property string $body
 * @property int $id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $commentable
 * @mixin Eloquent
 */
class Comment extends Model
{
    protected $fillable = ['parent_id', 'body', 'author_id'];

    protected $with = ['author'];

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->oldest();
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
