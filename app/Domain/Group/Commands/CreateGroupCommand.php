<?php

declare(strict_types=1);

namespace Domain\Group\Commands;

use App\Http\Requests\Request;
use App\Group;

/**
 * Class CreateGroupCommand
 * @package Domain\Group\Commands
 */
class CreateGroupCommand
{
    /**
     * @var Request
     */
    private $request;

    /**
     * CreateGroupCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $group = new Group();
        $group->fill($this->request->all());

        return $group->save();
    }
}
