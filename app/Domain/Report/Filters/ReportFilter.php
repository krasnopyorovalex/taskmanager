<?php

declare(strict_types=1);

namespace Domain\Report\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ReportFilter
 * @package App\Filter
 */
final class ReportFilter extends Filter
{
    /**
     * Registered sorts to operate upon.
     *
     * @var array
     */
    protected $filters = ['performer'];

    /**
     * Filter the query by a given performer.
     *
     * @param string $performer
     * @return Builder
     */
    protected function performer(string $performer): Builder
    {
        return $this->builder->where('performer_id', (int)$performer);
    }
}
