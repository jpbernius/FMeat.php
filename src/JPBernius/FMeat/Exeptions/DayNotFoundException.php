<?php

namespace JPBernius\FMeat\Exeptions;

use Exception;

/**
 * Class DayNotFoundException
 * @package JPBernius\FMeat\Exeptions
 */
class DayNotFoundException extends Exception
{
    /**
     * DayNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('Day not found');
    }
}