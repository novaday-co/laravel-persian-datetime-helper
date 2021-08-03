<?php
namespace NovadayCo\Datetime;

use Carbon\Carbon;
use Exception;

class DateTimeHelper
{
    private static $instance = null;
    public $dateTime;

    /**
     * parse DateTime And return Instance From That
     * @param $datetime
     * @return DateTimeHelper|null
     */
    public static function parse($datetime = null)
    {
        if(!is_null($datetime)){
            $datetime = convertToDashFormat($datetime);
            $datetime = completeTimeFormat($datetime);
        }

        if(!is_null($datetime) && !validateDateTime($datetime))
            throw new \InvalidArgumentException('Invalid DateTime : ' . $datetime);

        if (self::$instance == null)
            self::$instance = new DateTimeHelper();

        self::$instance->dateTime = $datetime ?? jdate()->format('Y-m-d H:i:s');
        return self::$instance;
    }

    /**
     * return DateTime With Given Format
     * @param $format
     * @return string
     */
    public function format($format)
    {
        return jdate(self::jalaliToGregorian(self::$instance->dateTime))->format($format);
    }

    /**
     * Convert Jalali Datetime To Gregorian
     * @param $jdate
     * @return string
     */
    public static function jalaliToGregorian($jdate)
    {
        $miladi_array = \Morilog\Jalali\CalendarUtils::toGregorian(
          datetimeSlice($jdate, 'year'),
          datetimeSlice($jdate, 'month'),
          datetimeSlice($jdate, 'day')
        );

        $miladi_array = array_map(function($val) { return datetimeIn2Digit($val); }, $miladi_array);

        $date = implode('-', $miladi_array);

        return $date . " " . datetimeSlice($jdate, 'time');

    }

    /**
     * Get Diff Months From Jalali Dates
     * @param $fromDateTime
     * @param $toDateTime
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInMonths($fromDateTime, $toDateTime)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDateTime);
        $miladiToDate = self::jalaliToGregorian($toDateTime);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInMonths($deadlineDate, false);
    }

    /**
     * Get Diff Day From Jalali Dates
     * @param $fromDateTime
     * @param $toDateTime
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInDays($fromDateTime, $toDateTime)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian($fromDateTime);
        $miladiToDate = self::jalaliToGregorian($toDateTime);

        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);

        return $startDate->diffInDays($deadlineDate, false);
    }

    /**
     * Get Diff Hour From Jalali Dates
     * @param $fromDateTime
     * @param $toDateTime
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInHours($fromDateTime, $toDateTime)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian((validateDateTime($fromDateTime, 'Y-m-d H:i:s')) ? $fromDateTime : createDateTimeFromTime($fromDateTime));
        $miladiToDate = self::jalaliToGregorian((validateDateTime($toDateTime, 'Y-m-d H:i:s')) ? $toDateTime : createDateTimeFromTime($toDateTime));


        $carbon = new Carbon();
        $startDate = $carbon::parse($miladiFromDate);
        $deadlineDate = $carbon::parse($miladiToDate);


        return $startDate->diffInHours($deadlineDate, false);
    }

    /**
     * Get Diff Minutes From Jalali Dates
     * @param $fromDateTime
     * @param $toDateTime
     * @return int
     * @throws Exception
     */
    public static function jalaliDiffInMinutes($fromDateTime, $toDateTime)
    {
        // convert to gregorian
        $miladiFromDate = self::jalaliToGregorian((validateDateTime($fromDateTime, 'Y-m-d H:i:s')) ? $fromDateTime : createDateTimeFromTime($fromDateTime));
        $miladiToDate = self::jalaliToGregorian((validateDateTime($toDateTime, 'Y-m-d H:i:s')) ? $toDateTime : createDateTimeFromTime($toDateTime));

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
    public static function clearTime($dateTime)
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
    public static function getMinutes($dateTime)
    {
        return Carbon::parse($dateTime)->hour * 60 + Carbon::parse($dateTime)->minute;
    }

    /**
     * Get First Day Of Month From Given jalali DateTime
     * @param $dateTime
     * @return float|int
     */
    public static function firstDayOfMonth($dateTime)
    {
        $miladiDatetime = self::jalaliToGregorian($dateTime);
        $yearAndMonth = jdate($miladiDatetime)->format('Y-m');
        return $yearAndMonth . '-01 00:00:00';
    }

    /**
     * Get Last Day Of Month From Given jalali DateTime
     * @param $dateTime
     * @return float|int
     */
    public static function lastDayOfMonth($dateTime)
    {
        $miladiDatetime = self::jalaliToGregorian($dateTime);
        $lastDay = jdate($miladiDatetime)->getMonthDays();
        $yearAndMonth = jdate($miladiDatetime)->format('Y-m');
        return $yearAndMonth . '-' . $lastDay . ' 00:00:00';
    }

    /**
     * Get First Day Of Year jalali
     * @return string
     */
    public static function firstDayOfYear()
    {
        return jdate()->getYear()  . '-' . '01' . '-' . '01' . ' 00:00:00';

    }

    /**
     * Get Last Day Of Year jalali
     * @return string
     */
    public static function lastDayOfYear()
    {
        $firstOfNextYear = jdate()->addYears(1)->getYear() . '-' . '01' . '-' . '01' . ' 23:59:59';
        $lastDayOfYearMiladi = Carbon::parse(self::jalaliToGregorian($firstOfNextYear))->subDay()->format('Y-m-d H:i:s');

        return jdate($lastDayOfYearMiladi)->format('Y-m-d H:i:s');
    }


}
