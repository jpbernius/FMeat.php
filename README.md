# FMeat.php

[![Build Status](https://travis-ci.org/jpbernius/FMeat.php.svg?branch=master)](https://travis-ci.org/jpbernius/FMeat.php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jpbernius/fmeat.php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jpbernius/fmeat.php/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/jpbernius/fmeat.php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jpbernius/fmeat.php/?branch=master)
[![Total Downloads](https://poser.pugx.org/jpbernius/fmeat/downloads)](https://packagist.org/packages/jpbernius/fmeat)

PHP Library for accessing the FMeat API.

## Installation

```
composer require jpbernius/fmeat
```

## Usage

```php
use JPBernius\FMeat\FMeatClient;

$fmeat = new FMeatClient();
$week = $fmeat->getCurrentWeek();

foreach ($week as $day) {
  foreach ($day as $dish) {
	echo($dish->getName());
  }
}
```
