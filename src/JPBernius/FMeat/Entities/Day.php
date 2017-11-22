<?php

namespace JPBernius\FMeat\Entities;

use DateTime;
use DateTimeInterface;
use Iterator;

class Day implements Entity, Iterator
{

    /** @var DateTimeInterface */
    private $date;

    /** @var array */
    private $dishes = [];

    public function __construct(DateTimeInterface $date)
    {
        $this->date = $date;
    }

    public function addDish(Dish $dish): void
    {
        if (!in_array($dish, $this->dishes)) {
            $this->dishes[] = $dish;
        }
    }

    public static function fromJson(\stdClass $jsonObject): self
    {
        $date = DateTime::createFromFormat('Y-m-d', $jsonObject->date);
        $day = new Day($date);

        foreach ($jsonObject->dishes as $jsonDishObject) {
            $dish = Dish::fromJson($jsonDishObject);
            $day->addDish($dish);
        }

        return $day;
    }

    public function getDayOfWeek(): int
    {
        return intval($this->date->format('N'));
    }

    //region Iterator

    /** @var int */
    private $position = 0;

    public function current(): Dish
    {
        return $this->dishes[$this->position];
    }

    public function next(): void
    {
        $this->position = $this->position + 1;
    }

    public function key(): int
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