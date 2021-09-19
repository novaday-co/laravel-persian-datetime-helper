<h1 align="center">Laravel Persian DateTime Helper</h1>
<p align="center">
  <img alt="GitHub code size in bytes" src="https://img.shields.io/github/languages/code-size/novaday-co/laravel-persian-datetime-helper.svg">
  <img alt="GitHub" src="https://img.shields.io/github/license/novaday-co/laravel-persian-datetime-helper.svg">
</p>

## Install

### Composer
Installing with composer is recommended and it simply works :<br><br>
```composer
composer require novaday-co/laravel-persian-datetime-helper
```

### Download
You can download latest version from the Github: Download

## Quick start
To use in your project, just import `DateTimeHelper` class : <br>


```php
$instance = DateTimeHelper::parse('1400-04-13 15:16:10') : DateTimeHelper
$instance = DateTimeHelper::parse('1400/04/13 15:16:10') : DateTimeHelper
$instance = DateTimeHelper::parse('1400_04_13 15:16:10') : DateTimeHelper
// $instance->dateTime = '1400-04-13 15:16:10'

DateTimeHelper::parse('1400-04-13 15:16:10')->format('Y-m-d') : string
// 1400-04-13

DateTimeHelper::parse('1400/04/13 15:16:10')->format('Y/m/d') : string
// 1400/04/13
```
---

```php
// Accept H:i Format

DateTimeHelper::parse('1400/04/13 15:16')->format('Y-m-d H:i:s') :  string ('Y-m-d H:i:s')
// 1400-04-13 15:16:00
```
---

```php
// Clone

$jalaliDateTime = DateTimeHelper::parse('1400-04-13 15:16:10');
$cloneJalaliDateTime = DateTimeHelper::copy($jalaliDateTime)->format('Y-m-d H:i:s');
// 1400-04-13 15:16:10
// $jalaliDateTime == $cloneJalaliDateTime
// $jalaliDateTime !== $cloneJalaliDateTime
```
---

```php
//ignore multiple space from input

$instance = DateTimeHelper::parse('1400-04-13   15:16:10') : DateTimeHelper
// $instance->dateTime = '1400-04-13 15:16:10'
```
---

```php
DateTimeHelper::jalaliToGregorian('1400-04-13 15:16:10') : string ('Y-m-d H:i:s')
// 2021-07-04 15:16:10

DateTimeHelper::jalaliToGregorian('1400-04-13') : string ('Y-m-d H:i:s')
// 2021-07-04 00:00:00
```
---

```php
DateTimeHelper::jalaliDiffInMonths('1400-02-23 10:27:52', '1400-04-23 15:16:10') : int
// 2

DateTimeHelper::jalaliDiffInMonths('1400-02-23', '1400-04-23') : int
// 2
```
---

```php
DateTimeHelper::jalaliDiffInDays('1400-02-13 15:16:10', '1400-02-23 10:27:52') : int
// 9

DateTimeHelper::jalaliDiffInDays('1400-02-13', '1400-02-23') : int
// 10
```
---

```php
DateTimeHelper::jalaliDiffInHours('1400-04-23 15:16:10', '1400-04-23 22:27:52') : int
// 7

DateTimeHelper::jalaliDiffInHours('15:16:10', '22:27:52') : int
// 7
```
---
```php
DateTimeHelper::jalaliDiffInMinutes('1400-04-23 15:16:10', '1400-04-23 22:27:52') : int
// 431

DateTimeHelper::jalaliDiffInMinutes('15:16:10', '22:27:52') : int
// 431
```
---

```php
DateTimeHelper::clearTime('1400-04-23 15:16:10') :  string ('Y-m-d H:i:s')
// 1400-04-23 00:00:00
```
---
```php
DateTimeHelper::getMinutes('1400-04-23 15:16:10') :  int
// 916 = 15*60 + 16
```
---
```php
DateTimeHelper::firstDayOfMonth('1400-04-23 15:16:10') :  string ('Y-m-d H:i:s')
// 1400-04-01 00:00:00

DateTimeHelper::firstDayOfMonth('1400-04-23') :  string ('Y-m-d H:i:s')
// 1400-04-01 00:00:00
```
---
```php
DateTimeHelper::lastDayOfMonth('1400-04-23 15:16:10') :  string ('Y-m-d H:i:s')
// 1400-04-31 00:00:00

DateTimeHelper::lastDayOfMonth('1400-08-23') :  string ('Y-m-d H:i:s')
// 1400-08-30 00:00:00
```
---
```php
DateTimeHelper::firstDayOfYear() :  string ('Y-m-d H:i:s')
// 1400-01-01 00:00:00
```
---
```php
DateTimeHelper::lastDayOfYear() :  string ('Y-m-d H:i:s')
// 1400-12-29 23:59:59
```




## License
### MIT
