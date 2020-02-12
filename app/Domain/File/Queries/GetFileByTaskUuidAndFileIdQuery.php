<?php

declare(strict_types=1);

namespace Domain\File\Queries;

use App\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GetFileByTaskUuidAndFileIdQuery
 * @package Domain\File\Queries
 */
class GetFileByTaskUuidAndFileIdQuery
{
    /**
     * @var string
     */
    private $uuid;
    /**
     * @var int
     */
    private $id;

    /**
     * GetFileByTaskUuidAndFileIdQuery constructor.
     * @param string $uuid
     * @param int $id
     */
    public function __construct(string $uuid, int $id)
    {
        $this->uuid = $uuid;
        $this->id = $id;
    }

    /**
     * @return Builder|Model
     */
    public function handle()
    {
        $uuid = $this->uuid;

        return File::select(['path', 'name'])->where('id', $this->id)->whereHas('task', static function (Builder $query) use ($uuid) {
            $query->where('uuid', $uuid);
        })->firstOrFail();
    }
}
