<?php

declare(strict_types=1);

namespace Domain\Group\Commands;

use Domain\Group\Queries\GetGroupByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateGroupCommand
 * @package Domain\Group\Commands
 */
class UpdateGroupCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    private $except = [
        'password',
        'password_confirmation'
    ];

    /**
     * UpdateGroupCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $group = $this->dispatch(new GetGroupByIdQuery($this->id));

        if ($this->request->get('password') && $this->validatePassword()->validate()) {
            $group->password = Hash::make($this->request->get('password'));
        }

        return $group->update($this->request->except($this->except));
    }

    /**
     * @return mixed
     */
    private function validatePassword()
    {
        return Validator::make($this->request->only($this->except), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

}
