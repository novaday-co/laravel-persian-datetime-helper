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




}
