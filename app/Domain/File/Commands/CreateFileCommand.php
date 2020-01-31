<?php

declare(strict_types=1);

namespace Domain\File\Commands;

use App\File;
use App\Http\Requests\Request;
use App\Task;

/**
 * Class CreateFileCommand
 * @package Domain\File\Commands
 */
class CreateFileCommand
{
    /**
     * @var Task
     */
    private $task;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request, Task $task)
    {
        $this->request = $request;
        $this->task = $task;
    }

    public function handle()
    {
        $file = new File();

    }
}
