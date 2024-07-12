<?php

$baseDate = new DateTime();
$interval = ["min" => 2, "max" => 14];
$endDate = clone $baseDate;
$endDate->add(new DateInterval('P'. rand($interval["min"], $interval["max"]). 'D'));
var_dump($baseDate, $endDate);