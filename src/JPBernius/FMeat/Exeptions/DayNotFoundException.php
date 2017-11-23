<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 23.11.17
 * Time: 11:11
 */

namespace JPBernius\FMeat\Exeptions;

use Exception;

class DayNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Day not found");
    }
}