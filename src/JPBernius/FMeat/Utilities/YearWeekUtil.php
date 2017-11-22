<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 19:16
 */

namespace JPBernius\FMeat\Utilities;


class YearWeekUtil
{
    public function getCurrentYear(): int {
        return intval(date("Y"));
    }

    public function getCurrentCalendarWeek(): int {
        return intval(date("W"));
    }


}