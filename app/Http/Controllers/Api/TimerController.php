<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Timer\Queries\TimerStartQuery;
use Domain\Timer\Queries\TimerStopQuery;

/**
 * Class TimerController
 * @package App\Http\Controllers
 */
class TimerController extends Controller
{
    public function start(int $id)
    {
        $this->dispatch(new TimerStartQuery($id));

        return response([], 204);
    }

    public function stop(int $id)
    {
        $this->dispatch(new TimerStopQuery($id));

        return response([], 204);
    }
}
