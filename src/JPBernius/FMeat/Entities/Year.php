<?php

namespace JPBernius\FMeat\Entities;

use Iterator;

/**
 * Class Year
 * @package JPBernius\FMeat\Entities
 */
class Year implements Entity, Iterator
{
    /** @var int */
    private $yearNumber;

    /** @var array */
    private $weeks = [];

    /**
     * Year constructor.
     * @param int|null $yearNumber
     */
    public function __construct(int $yearNumber = null)
    {
        if (is_null($yearNumber)) {
            $yearNumber = intval(date("Y"));
        }

        $this->yearNumber = $yearNumber;
    }

    /**
     * @param string $jsonString
     * @return Year
     */
    public static function fromJson(\stdClass $jsonObject): self
    {
        return new Year($jsonObject->year);
    }

    /**
     * @return mixed
     */
    public function getYearNumber(): int
    {
        return $this->yearNumber;
    }

    /**
     * @param Week $week
     */
    public function addWeek(Week $week): void
    {
        $this->weeks[$week->getWeekNumber() - 1] = $week;
    }

    /**
     * @param int $weekNumber
     * @return Week
     */
    public function getWeek(int $weekNumber): Week
    {
        if (empty($this->weeks[$weekNumber])) {
            return null;
        }

        return $this->weeks[$weekNumber];
    }

    //region Iterator

    const WEEKS_PER_YEAR = 52;

    /** @var int */
    private $position = 0;

    /**
     * @return Week
     */
    public function current(): Week
    {
        return $this->getWeek($this->position);
    }

    public function next(): void
    {
        $this->position = ($this->position + 1) % self::WEEKS_PER_YEAR;
    }

    public function key(): int
    {
        return $this->position + 1;
    }

    public function valid(): bool
    {
        return $this->current() !== null;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    //endregion
}