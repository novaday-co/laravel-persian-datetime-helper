<?php

namespace FarazinCo\Datetime\Tests;

use FarazinCo\Datetime\DateTimeHelper;
use PHPUnit\Framework\TestCase;

final class DateTimeHelperTest extends TestCase
{
    public function testJalaliToGregorian()
    {
        $jalaliDateTime = DateTimeHelper::jalaliToGregorian('1400-04-13 15:16:10');
        $this->assertEquals($jalaliDateTime, "2021-07-04 15:16:10");
    }

    public function testJalaliDiffInMonths()
    {
        $jalaliDateTime = DateTimeHelper::jalaliDiffInMonths('1400-02-23 10:27:52', '1400-04-23 15:16:10');
        $jalaliDate = DateTimeHelper::jalaliDiffInMonths('1400-02-23', '1400-04-23');
        $this->assertEquals($jalaliDateTime, 2);
        $this->assertEquals($jalaliDate, 2);
    }

    public function testJalaliDiffInDays()
    {
        $jalaliDateTime = DateTimeHelper::jalaliDiffInDays('1400-02-13 15:16:10', '1400-02-23 10:27:52');
        $jalaliDate = DateTimeHelper::jalaliDiffInDays('1400-02-13', '1400-02-23');
        $this->assertEquals($jalaliDateTime, 9);
        $this->assertEquals($jalaliDate, 10);
    }

    public function testJalaliDiffInHours()
    {
        $jalaliDateTime = DateTimeHelper::jalaliDiffInHours('1400-04-23 15:16:10', '1400-04-23 22:27:52');
        $jalaliTime = DateTimeHelper::jalaliDiffInHours('15:16:10', '22:27:52');
        $this->assertEquals($jalaliDateTime, 7);
        $this->assertEquals($jalaliTime, 7);
    }

    public function testJalaliDiffInMinutes()
    {
        $jalaliDateTime = DateTimeHelper::jalaliDiffInMinutes('1400-04-23 15:16:10', '1400-04-23 22:27:52');
        $jalaliTime = DateTimeHelper::jalaliDiffInMinutes('15:16:10', '22:27:52');
        $this->assertEquals($jalaliDateTime, 431);
        $this->assertEquals($jalaliTime, 431);
    }

    public function testClearTime()
    {
        $jalaliDateTime = DateTimeHelper::clearTime('1400-04-23 15:16:10');
        $this->assertEquals($jalaliDateTime, "1400-04-23 00:00:00");
    }

    public function testGetMinutes()
    {
        $jalaliDateTime = DateTimeHelper::getMinutes('1400-04-23 15:16:10');
        $this->assertEquals($jalaliDateTime, 916);
    }

    public function testFirstDayOfMonth()
    {
        $jalaliDateTime = DateTimeHelper::firstDayOfMonth('1400-04-23 15:16:10');
        $jalaliDate = DateTimeHelper::firstDayOfMonth('1400-04-23');
        $this->assertEquals($jalaliDateTime, "1400-04-01 00:00:00");
        $this->assertEquals($jalaliDate, "1400-04-01 00:00:00");
    }

    public function testLastDayOfMonth()
    {
        $jalaliDateTime = DateTimeHelper::lastDayOfMonth('1400-04-23 15:16:10');
        $jalaliDate = DateTimeHelper::lastDayOfMonth('1400-08-23');
        $this->assertEquals($jalaliDateTime, "1400-04-31 00:00:00");
        $this->assertEquals($jalaliDate, "1400-08-30 00:00:00");
    }

    public function testFirstDayOfYear()
    {
        $jalaliDateTime = DateTimeHelper::firstDayOfYear();
        $this->assertEquals($jalaliDateTime, "1400-01-01 00:00:00");
    }

    public function testLastDayOfYear()
    {
        $jalaliDateTime = DateTimeHelper::lastDayOfYear();
        $this->assertEquals($jalaliDateTime, "1400-12-29 23:59:59");
    }
}