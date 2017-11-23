<?php

namespace JPBernius\FMeat\Entities;

use JsonSerializable;

/**
 * Interface Entity
 * @package JPBernius\FMeat\Entities
 */
interface Entity extends JsonSerializable
{
    /**
     * @param \stdClass $jsonString
     * @return mixed
     */
    public static function fromJson(\stdClass $jsonString);
}