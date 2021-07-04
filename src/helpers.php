<?php


if (! function_exists('datetime_slice')) {
    /**
     * @param $datetime_string
     * @param $slice_type
     * @return bool
     */
    function datetime_slice($datetime_string, $slice_type)
    {

        $datetime_string = convert_numbers_to_english($datetime_string);
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

if (! function_exists('convert_numbers_to_english')) {
    /**
     * @param $string
     * @return mixed
     */
    function convert_numbers_to_english($string)
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