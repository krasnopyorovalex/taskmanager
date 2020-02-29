<?php

declare(strict_types=1);

namespace Domain\Report\Dto;

/**
 * Class DatePeriodDto
 * @package Domain\Report\Dto
 */
class DatePeriodDto
{
    /**
     * @var string
     */
    private $dateStart;
    /**
     * @var string
     */
    private $dateStop;

    public function __construct(string $dateStart, string $dateStop)
    {
        $this->dateStart = $dateStart;
        $this->dateStop = $dateStop;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return string
     */
    public function getDateStop(): string
    {
        return $this->dateStop;
    }
}
