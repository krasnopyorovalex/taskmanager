<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserGroup
 * @package App
 *
 * @property string $name
 */
class UserGroup extends Model
{
    public $timestamps = false;

    protected $guarded = [];
}
