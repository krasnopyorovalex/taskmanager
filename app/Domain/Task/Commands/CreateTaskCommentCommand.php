<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Comment;
use App\Http\Requests\Request;
use App\Task;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateTaskCommentCommand
 * @package Domain\Task\Commands
 */
class CreateTaskCommentCommand
{
    use DispatchesJobs;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var string
     */
    private $uuid;

    /**
     * CreateTaskCommentCommand constructor.
     * @param Request $request
     * @param string $uuid
     */
    public function __construct(Request $request, string $uuid)
    {
        $this->request = $request;
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        /** @var Task $task */
        $task = $this->dispatch(new GetTaskByUuidQuery($this->uuid));

        $comment = new Comment();

        return $task->comments()->save($comment->fill($this->request->all()));
    }
}
