<?php
namespace Barryvdh\Queue;

use Carbon\Carbon;
use Exception;

class DateTimeHelper
{

    /**
     * @param $jdate
     * @return string
     */
    public static function jalaliToGregorian($jdate)
    {
        $miladi_array = \Morilog\Jalali\CalendarUtils::toGregorian(
          datetime_slice($jdate, 'year'),
          datetime_slice($jdate, 'month'),
          datetime_slice($jdate, 'day')
        );

        $miladi_array = array_map(function($val) { return datetimeIn2Digit($val); }, $miladi_array);

        $date = implode('-', $miladi_array);

        return $date . " " . datetime_slice($jdate, 'time');

    }

    /**
     * Get Diff Months From Jalali Dates
     * @param $fromDate
     * @param $toDate
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInMonths($fromDate, $toDate)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDate);
        $miladiToDate = self::jalaliToGregorian($toDate);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInMonths($deadlineDate, false);
    }

    /**
     * Get Diff Day From Jalali Dates
     * @param $fromDate
     * @param $toDate
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInDays($fromDate, $toDate)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDate);
        $miladiToDate = self::jalaliToGregorian($toDate);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInDays($deadlineDate, false);
    }

    /**
     * Get Diff Hour From Jalali Dates
     * @param $fromDate
     * @param $toDate
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInHours($fromDate, $toDate)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDate);
        $miladiToDate = self::jalaliToGregorian($toDate);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInHours($deadlineDate, false);
    }

    /**
     * Get Diff Minutes From Jalali Dates
     * @param $fromDate
     * @param $toDate
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInMinutes($fromDate, $toDate)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDate);
        $miladiToDate = self::jalaliToGregorian($toDate);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInMinutes($deadlineDate, false);
    }

    /**
     * Make Time Zero From DateTime
     * @param $dateTime
     * @return Carbon
     */
    public function clearTime($dateTime)
    {
        $dt = Carbon::now();
        $dt->year(Carbon::parse($dateTime)->year);
        $dt->month(Carbon::parse($dateTime)->month);
        $dt->day(Carbon::parse($dateTime)->day);
        $dt->hour(00);
        $dt->minute(00);
        $dt->second(00);

        return $dt;
    }

    /**
     * Get Minutes From DateTime
     * @param $dateTime
     * @return float|int
     */
    public function getMinutes($dateTime)
    {
        return Carbon::parse($dateTime)->hour * 60 + Carbon::parse($dateTime)->minute;
    }

    /**
     * Get First Day Of Month From Given jalali DateTime
     * @param $dateTime
     * @return float|int
     */
    public function firstDayOfMonth($dateTime)
    {
        $miladiDatetime = self::jalaliToGregorian($dateTime);
        $yearAndMonth = jdate($miladiDatetime)->format('Y-m');
        return $yearAndMonth . '-01 00:00:00';
    }


}
