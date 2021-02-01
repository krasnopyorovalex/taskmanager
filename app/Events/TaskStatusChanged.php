<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TaskStatusChanged
 * @package App\Events
 */
class TaskStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $body;

    /**
     * NewStoryHasAppeared constructor.
     * @param string $body
     */
    public function __construct(string $body)
    {
        $this->body = $body;
    }
}
