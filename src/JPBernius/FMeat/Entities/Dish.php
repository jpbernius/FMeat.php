<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 17:48
 */

namespace JPBernius\FMeat\Entities;


/**
 * Class Dish
 * @package JPBernius\FMeat\Entities
 */
class Dish implements Entity
{

    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /**
     * Dish constructor.
     * @param string $name
     * @param float $price
     */
    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @param \stdClass $jsonObject
     * @return Dish
     */
    public static function fromJson(\stdClass $jsonObject): self
    {
        return new Dish($jsonObject->name, $jsonObject->price);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}