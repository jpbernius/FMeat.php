<?php

namespace JPBernius\FMeat\Exeptions;

use Exception;

/**
 * Class NetworkingException
 * @package JPBernius\FMeat\Exeptions
 */
class NetworkingException extends Exception
{
    /**
     * NetworkingException constructor.
     */
    public function __construct()
    {
        parent::__construct("Networking Error occured.");
    }
}