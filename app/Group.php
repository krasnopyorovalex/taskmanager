<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @package App
 *
 * @property string $name
 */
class Group extends Model
{
    public $timestamps = false;

    protected $guarded = [];
}
