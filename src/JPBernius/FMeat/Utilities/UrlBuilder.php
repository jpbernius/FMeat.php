<?php

namespace JPBernius\FMeat\Utilities;

use JPBernius\FMeat\Configurations\Urls;

class UrlBuilder
{
    public function getUrlForLocationYearWeek(string $location, int $year, int $weekNumber)
    {
        $formattedWeekNumber = $this->formatWeekNumber($weekNumber);
        return sprintf(Urls::API_URL, $location, $year, $formattedWeekNumber);
    }

    private function formatWeekNumber(int $weekNumber): string {
        return sprintf('%02d', $weekNumber);
    }
}