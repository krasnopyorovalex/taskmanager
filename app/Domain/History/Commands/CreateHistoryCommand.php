<?php

declare(strict_types=1);

namespace Domain\History\Commands;

use App\Events\NewStoryHasAppeared;
use App\History;
use Illuminate\Support\Facades\Date;

/**
 * Class CreateHistoryCommand
 * @package Domain\History\Commands
 */
class CreateHistoryCommand
{
    /**
     * @var NewStoryHasAppeared
     */
    private $event;

    /**
     * CreateHistoryCommand constructor.
     * @param NewStoryHasAppeared $event
     */
    public function __construct(NewStoryHasAppeared $event)
    {
        $this->event = $event;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $history = new History();
        $history->user_id = auth()->id();
        $history->body = $this->event->body;
        $history->created_at = Date::now();

        return $history->save();
    }
}
