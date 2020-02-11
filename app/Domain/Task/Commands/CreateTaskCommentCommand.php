<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Comment;
use App\Http\Requests\Request;
use App\Task;
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
     * @var Task
     */
    private $task;

    /**
     * CreateTaskCommentCommand constructor.
     * @param Request $request
     * @param Task $task
     */
    public function __construct(Request $request, Task $task)
    {
        $this->request = $request;
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $comment = new Comment();

        return $this->task->comments()->save($comment->fill($this->request->all()));
    }
}
