<?php

namespace JPBernius\FMeat\Entities;

use Iterator;

/**
 * Class Week
 * @package JPBernius\FMeat\Entities
 */
class Week implements Entity, Iterator
{
    /** @var int */
    private $weekNumber;

    /** @var array */
    private $days = [];

    /**
     * Week constructor.
     * @param $weekNumber
     * @param Year|null $year
     */
    public function __construct($weekNumber, Year $year = null)
    {
        $this->weekNumber = $weekNumber;
        $this->year = $year;
    }

    /**
     * @param string $jsonString
     * @return Week
     */
    public static function fromJson(\stdClass $jsonObject): self
    {
        $week = new Week($jsonObject->number);

        foreach ($jsonObject->days as $jsonDayObject) {
            $day = Day::fromJson($jsonDayObject);
            $week->addDay($day);
        }
        
        return $week;
    }

    /**
     * @return int
     */
    public function getWeekNumber(): int
    {
        return $this->weekNumber;
    }

    /**
     * @param Day $day
     */
    public function addDay(Day $day): void
    {
        $this->days[$day->getDayOfWeek() - 1] = $day;
    }

    /**
     * @param int $dayOfWeek
     * @return mixed|null
     */
    public function getDay(int $dayOfWeek): Day
    {
        if (empty($this->days[$dayOfWeek -1])) {
            return null;
        }

        return $this->days[$dayOfWeek -1];
    }

    //region Iterator

    const DAYS_PER_WEEK = 5;

    /** @var int */
    private $position = 0;

    /**
     * @return Day
     */
    public function current(): Day
    {
        return $this->getDay($this->position);
    }

    public function next(): void
    {
        $this->position = ($this->position + 1) % self::DAYS_PER_WEEK;
    }

    public function key()
    {
        return $this->position;
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