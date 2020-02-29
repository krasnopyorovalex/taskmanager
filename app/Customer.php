<?php

declare(strict_types=1);

namespace App;

use App\Scopes\WithCustomersByMyGroupsScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Customer
 * @package App
 */
class Customer extends Model
{
    use CommentableTrait;

    protected $guarded = [];

    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new WithCustomersByMyGroupsScope);
    }

    /**
     * Get the manager.
     *
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
