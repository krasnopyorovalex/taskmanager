<?php

declare(strict_types=1);

namespace Domain\Task\Entities;

use App\Task;
use ReflectionClass;
use ReflectionException;

/**
 * Interface TaskStatus
 * @package App\Domain\Task\Entities
 */
abstract class AbstractTaskStatus
{
    /**
     * @return array|null
     */
    public function toArray(): ?array
    {
        try {
            $reflectionClass = (new ReflectionClass(__CLASS__))->newInstance();

            $constants = [];
            foreach ($reflectionClass->getConstants() as $value) {
                $constants[] = $value;
            }

            return $constants;
        } catch (ReflectionException $e) {
            return [];
        }
    }

    abstract public function onlyActual(): array;

    abstract public function onlyInWork(): string;

    abstract public function getLabelStatus(Task $task): string;

    abstract public function icon(Task $task): string;

    abstract public function inWork(Task $task): bool;

    abstract public function changeStatus(Task $task): string;
}
