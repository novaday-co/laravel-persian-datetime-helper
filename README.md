<h1 align="center">Laravel Persian DateTime Helper</h1>
<p align="center">
  <img alt="GitHub code size in bytes" src="https://img.shields.io/github/languages/code-size/hosein-xz/laravel-persian-datetime-helper.svg">
  <img alt="GitHub" src="https://img.shields.io/github/license/hosein-xz/laravel-persian-datetime-helper.svg">
</p>

## Install

### Composer
Installing with composer is recommended and it simply works :<br><br>
```
composer install FarazinCo\laravel-persian-datetime-helper
```

### Download
You can download latest version from the Github: Download

## Quick start
To use in your project, just import `DateTimeHelper` class : <br>


```
DateTimeHelper::jalaliToGregorian('1400-04-13 15:16:10') : jdate ('Y-m-d H:i:s')
// 2021-07-04 15:16:10

DateTimeHelper::jalaliToGregorian('1400-04-13') : jdate ('Y-m-d H:i:s')
// 2021-07-04 00:00:00
```
---

```
DateTimeHelper::jalaliDiffInMonths('1400-02-23 10:27:52', '1400-04-13 15:16:10') : int
// 2

DateTimeHelper::jalaliDiffInMonths('1400-02-23', '1400-04-13') : int
// 2
```
---

```
DateTimeHelper::jalaliDiffInDays('1400-02-13 15:16:10', '1400-02-23 10:27:52') : int
// 10

DateTimeHelper::jalaliDiffInDays('1400-02-13', '1400-02-23') : int
// 10
```
---

```
DateTimeHelper::jalaliDiffInHours('1400-04-23 15:16:10', '1400-04-23 22:27:52') : int
// 7

DateTimeHelper::jalaliDiffInHours('15:16:10', '22:27:52') : int
// 7
```
---
```
DateTimeHelper::jalaliDiffInMinutes('1400-04-23 15:16:10', '1400-04-23 22:27:52') : int
// 431

DateTimeHelper::jalaliDiffInMinutes('15:16:10', '22:27:52') : int
// 431
```
---

```
DateTimeHelper::clearTime('1400-04-23 15:16:10') :  jdate ('Y-m-d H:i:s')
// 1400-04-23 00:00:00
```
---




## License
#### MIT