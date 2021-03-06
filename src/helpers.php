<?php


if (! function_exists('datetimeSlice')) {
    /**
     * @param $datetime_string
     * @param $slice_type
     * @return bool
     */
    function datetimeSlice($datetime_string, $slice_type)
    {

        $datetime_string = convertNumbersToEnglish($datetime_string);
        $by_space = explode(' ', $datetime_string);
        $by_colon_date = explode('-', $by_space[0]);
        $by_colon_time = explode(':', isset($by_space[1]) ? $by_space[1] : '00:00:00');
        switch ($slice_type) {
            case 'date':
                return $by_space[0];
                break;
            case 'time':
                return isset($by_space[1]) ? $by_space[1] : '00:00:00';
                break;
            case 'year':
                return $by_colon_date[0] ?? jdate()->getYear();
                break;
            case 'month':
                return $by_colon_date[1] ?? jdate()->getMonth();
                break;
            case 'day':
                return $by_colon_date[2] ?? jdate()->getDay();
                break;
            case 'hour':
                return $by_colon_time[0] ?? jdate()->getHour();
                break;
            case 'minute':
                return $by_colon_time[1] ?? jdate()->getMinute();
                break;
            case 'second':
                return $by_colon_time[2] ?? jdate()->getSecond();
                break;
        }

        return false;
    }
}

if (! function_exists('convertNumbersToEnglish')) {
    /**
     * @param $string
     * @return mixed
     */
    function convertNumbersToEnglish($string)
    {
        return \Morilog\Jalali\CalendarUtils::convertNumbers($string, true);
    }
}

if (! function_exists('datetimeIn2Digit')) {
    function datetimeIn2Digit($input)
    {

        $digitCount = strlen((string)$input);
        if ($digitCount == 1)
            return '0' . $input;
        else return $input;
    }
}

if (! function_exists('validateDateTime')) {
    function validateDateTime($dateTime, $format = 'Y-m-d H:i:s'){
        $dateTimeFormat = DateTime::createFromFormat($format, $dateTime);
        return $dateTimeFormat && $dateTimeFormat->format($format) === $dateTime;
    }
}

if (! function_exists('createDateTimeFromTime')) {
    /**
     * Set Time To Today Date - when date does not matter
     * @param $time
     * @return string
     */
    function createDateTimeFromTime($time){
        if(validateDateTime($time, 'H:i:s'))
            return jdate()->format('Y-m-d') . ' ' . $time;
        else
            throw new \InvalidArgumentException('Invalid Time : ' . $time);
    }
}

if (! function_exists('convertToDashFormat')) {
    /**
     * Convert / or _ in Date Format To -
     * @param $datetime
     * @return string
     */
    function convertToDashFormat($datetime){
        return str_replace('_', '-', str_replace('/', '-', removeMultipleSpaces($datetime)));
    }
}

if (! function_exists('removeMultipleSpaces')) {
    /**
     * Remove Multiple Spaces
     * @param $datetime
     * @return string
     */
    function removeMultipleSpaces($datetime){
        return preg_replace('/\s+/', ' ', $datetime);
    }
}

if (! function_exists('completeTimeFormat')) {
    /**
     * Add Seconds To Time Format If Format Was H:i
     * @param $datetime
     * @return string
     */
    function completeTimeFormat($datetime){
        $date = datetimeSlice($datetime, 'date');
        $time = datetimeSlice($datetime, 'time');
        if(strlen($time) == 5)
            $time = $time . ':00';

        return $date . ' ' . $time;

    }
}