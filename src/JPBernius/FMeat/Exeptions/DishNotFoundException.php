<?php

namespace JPBernius\FMeat\Exeptions;

use Exception;

/**
 * Class DishNotFoundException
 * @package JPBernius\FMeat\Exeptions
 */
class DishNotFoundException extends Exception
{
    /**
     * DishNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('Dish not found!');
    }
}