<?php

namespace JPBernius\FMeat\Entities;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * Class Year
 * @package JPBernius\FMeat\Entities
 */
class Year implements Entity, IteratorAggregate
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

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->weeks);
    }
}