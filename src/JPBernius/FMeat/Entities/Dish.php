<?php

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
            'name' => $this->getName(),
            'price' => $this->getPrice()
        ];
    }
}