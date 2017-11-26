<?php

namespace JPBernius\FMeat\Entities;

use ArrayIterator;
use IteratorAggregate;
use Traversable;
use JPBernius\FMeat\Exeptions\DayNotFoundException;

/**
 * Class Week
 * @package JPBernius\FMeat\Entities
 */
class Week implements Entity, IteratorAggregate
{
    /** @var int */
    private $weekNumber;

    /** @var array */
    private $days = [];

    /**
     * Week constructor.
     * @param $weekNumber
     */
    public function __construct($weekNumber)
    {
        $this->weekNumber = $weekNumber;
    }

    /**
     * @param \stdClass $jsonObject
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
     * @return Day
     * @throws DayNotFoundException
     */
    public function getDay(int $dayOfWeek): Day
    {
        if (empty($this->days[$dayOfWeek - 1])) {
            throw new DayNotFoundException();
        }

        return $this->days[$dayOfWeek - 1];
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->days);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array
    {
        return [
            'number' => $this->getWeekNumber(),
            'days' => array_map(function(Day $day) {
                return $day->jsonSerialize();
            }, $this->days)
        ];
    }
}