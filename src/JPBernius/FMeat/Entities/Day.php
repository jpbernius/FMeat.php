<?php

namespace JPBernius\FMeat\Entities;

use ArrayIterator;
use DateTime;
use DateTimeInterface;
use IteratorAggregate;
use Traversable;
use JPBernius\FMeat\Exeptions\DishNotFoundException;

/**
 * Class Day
 * @package JPBernius\FMeat\Entities
 */
class Day implements Entity, IteratorAggregate
{

    /** @var DateTimeInterface */
    private $date;

    /** @var array */
    private $dishes = [];

    /**
     * Day constructor.
     * @param DateTimeInterface $date
     */
    public function __construct(DateTimeInterface $date)
    {
        $this->date = $date;
    }

    /**
     * @param Dish $dish
     */
    public function addDish(Dish $dish): void
    {
        if (!in_array($dish, $this->dishes)) {
            $this->dishes[] = $dish;
        }
    }

    /**
     * @param int $index
     * @return Dish
     * @throws DishNotFoundException
     */
    public function getDish(int $index): Dish
    {
        if (empty($this->dishes[$index])) {
            throw new DishNotFoundException();
        }

        return $this->dishes[$index];
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \stdClass $jsonObject
     * @return Day
     */
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

    /**
     * @return int
     */
    public function getDayOfWeek(): int
    {
        return intval($this->date->format('N'));
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
        return new ArrayIterator($this->dishes);
    }
}