<?php

use Kuleshov\CheckCorrectParenthesis\StringCorrect;

require_once 'vendor/autoload.php';

unset($argv[0]);

$params = [];

foreach ($argv as $argument) {
    preg_match('/^-(.+)=(.+)$/', $argument, $matches);
    if (!empty($matches)) {
        $paramName = $matches[1];
        $paramValue = $matches[2];

        $params[$paramName] = $paramValue;
    }
}

if (!isset($params['path'])) {
    throw new InvalidArgumentException("Параметр path - является обязательным");
}

if (!file_exists($params['path'])) {
    throw new Exception("Файл не найден!");
}

$string = file_get_contents($params['path']);
$string = str_replace("\r\n", "", $string);

echo StringCorrect::checkParenthesis($string) ? 'true' : 'false';