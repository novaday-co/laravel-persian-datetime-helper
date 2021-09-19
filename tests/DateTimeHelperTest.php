<?php

namespace NovadayCo\Datetime\Tests;

use NovadayCo\Datetime\DateTimeHelper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class DateTimeHelperTest extends TestCase
{

    public function testParse()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400-04-13 15:16:10')->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, "1400-04-13 15:16:10");
    }

    public function testParseWithoutSeconds()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400/04/13 15:16')->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, "1400-04-13 15:16:00");
    }

    public function testParseWithMultipleSpaces()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400-04-13   15:16:10')->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, "1400-04-13 15:16:10");
    }

    public function testParseWithSlash()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400/04/13 15:16:10')->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, "1400-04-13 15:16:10");
    }

    public function testParseWithUnderline()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400_04_13 15:16:10')->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, "1400-04-13 15:16:10");
    }

    public function testParseWithoutInput()
    {

        $jalaliDateTime = DateTimeHelper::parse()->format('Y-m-d H:i:s');
        $this->assertEquals($jalaliDateTime, jdate()->format('Y-m-d H:i:s'));
    }

    public function testFailParse()
    {
        $this->expectException(InvalidArgumentException::class);
        DateTimeHelper::parse('1400-04-13 15:1');
    }

    public function testFormat()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400-04-13 15:16:12')->format('Y-m-d');
        $this->assertEquals($jalaliDateTime, "1400-04-13");
    }

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

    public function testFailJalaliDiffInMinutes()
    {

        $this->expectException(InvalidArgumentException::class);
        $jalaliTime = DateTimeHelper::jalaliDiffInMinutes('15:16', '22:27:52');
    }

    public function testClearTime()
    {
        $jalaliDateTime = DateTimeHelper::clearTime('1400-04-23 15:16:10');
        $this->assertEquals($jalaliDateTime, "1400-04-23 00:00:00");
    }

    public function testDatetimeSliceFunction()
    {
        $jalaliDate = datetimeSlice('1400-04-23 15:16:10', 'date');
        $this->assertEquals($jalaliDate, "1400-04-23");
        $jalaliHour = datetimeSlice('1400-04-23 15:16:10', 'hour');
        $this->assertEquals($jalaliHour, "15");
        $jalaliMinute = datetimeSlice('1400-04-23 15:16:10', 'minute');
        $this->assertEquals($jalaliMinute, "16");
        $jalaliSecond = datetimeSlice('1400-04-23 15:16:10', 'second');
        $this->assertEquals($jalaliSecond, "10");
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

    public function testCopyDateTime()
    {
        $jalaliDateTime = DateTimeHelper::parse('1400-04-13 15:16:10');
        $cloneJalaliDateTime = DateTimeHelper::copy($jalaliDateTime)->format('Y-m-d H:i:s');
        $this->assertEquals($cloneJalaliDateTime, "1400-04-13 15:16:10");
        $this->assertNotSame($cloneJalaliDateTime, $jalaliDateTime);
    }
}