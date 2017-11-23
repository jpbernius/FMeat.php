<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 23.11.17
 * Time: 11:13
 */

namespace JPBernius\FMeat\Exeptions;

use Exception;

class DishNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Dish not found!");
    }
}