<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App
 *
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $body
 */
class Comment extends Model
{
    protected $fillable = ['parent_id', 'body'];
}
