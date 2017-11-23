<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 23.11.17
 * Time: 16:58
 */

namespace JPBernius\FMeat\Exeptions;

use Exception;

class NetworkingException extends Exception
{
    public function __construct()
    {
        parent::__construct("Networking Error occured.");
    }
}