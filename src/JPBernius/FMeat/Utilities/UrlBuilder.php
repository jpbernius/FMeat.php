<?php

namespace JPBernius\FMeat\Utilities;

use JPBernius\FMeat\Configurations\Urls;
use JPBernius\FMeat\Entities\CalendarWeek;

class UrlBuilder
{
    public function getUrlForLocationYearWeek(string $location, CalendarWeek $calendarWeek)
    {
        return sprintf(Urls::API_URL, $location, $calendarWeek->getYear(), $calendarWeek->getWeek());
    }
}