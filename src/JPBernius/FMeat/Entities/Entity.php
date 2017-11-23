<?php

namespace JPBernius\FMeat\Entities;

/**
 * Interface Entity
 * @package JPBernius\FMeat\Entities
 */
interface Entity
{
    /**
     * @param \stdClass $jsonString
     * @return mixed
     */
    public static function fromJson(\stdClass $jsonString);
}