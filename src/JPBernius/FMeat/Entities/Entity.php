<?php

namespace JPBernius\FMeat\Entities;

interface Entity
{
	public static function fromJson(\stdClass $jsonString);
}