<?php

namespace JPBernius\FMeat\Entities;

class CalendarWeek {
        /** @var int */
        private $yearNumber;

        /** @var int */
        private $weekNumber;

        public function __construct($yearNumber, $weekNumber)
        {
            $this->yearNumber = $yearNumber;
            $this->weekNumber = $weekNumber;
        }

        public function getYear(): string
        {
            return strval($this->yearNumber);
        }
        
        public function getWeek(): string
        {
            return sprintf('%02d', $this->weekNumber);
        }
}