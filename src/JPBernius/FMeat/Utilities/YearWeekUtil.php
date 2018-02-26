<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 19:16
 */

namespace JPBernius\FMeat\Utilities;

use JPBernius\FMeat\Entities\CalendarWeek;

class YearWeekUtil
{
    public function getCurrentCalendarWeek(): CalendarWeek {
        $year = intval(date('Y'));
        $week = intval(date('W'));
        return new CalendarWeek($year, $week);
    }

    public function getNextCalendarWeek(): CalendarWeek {
        $year = intval(date('Y', strtotime("+1 week")));
        $week = intval(date('W', strtotime("+1 week")));
        return new CalendarWeek($year, $week);
    }
}