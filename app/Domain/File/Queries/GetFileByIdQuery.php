<?php

declare(strict_types=1);

namespace Domain\File\Queries;

use App\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetFileByIdQuery
 * @package Domain\File\Queries
 */
class GetFileByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetFileByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return File|File[]|Collection|Model
     */
    public function handle()
    {
        return File::findOrFail($this->id);
    }
}
