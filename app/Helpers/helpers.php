<?php

 if (!function_exists('getRusDate')) {
    function getRusDate($dateTime, $format = '%DAYWEEK%, d %MONTH% Y H:i', $offset = 0)
    {
        $monthArray = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $daysArray = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');

        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->timestamp;
        $timestamp += 3600 * $offset;

        $findArray = array('/%MONTH%/i', '/%DAYWEEK%/i');
        $replaceArray = array($monthArray[date("m", $timestamp) - 1], $daysArray[date("N", $timestamp) - 1]);
        $format = preg_replace($findArray, $replaceArray, $format);

        return date($format, $timestamp);
    }
}

if (!function_exists('uploads_path')) {
    function uploads_path()
    {
        return storage_path('app.uploads');
    }
}

if (!function_exists('parameters')) {
    function parameters($parameters)
    {
        if (is_null($parameters)) {
            $parameters = [];
        }

        if (is_string($parameters)) {
            $parameters = json_decode($parameters, true);
        } elseif (is_array($parameters)) {
            $parameters = $parameters;
        } elseif (is_object($parameters)) {
            $parameters = json_decode(json_encode($parameters), true);
        }

        return $parameters;
    }
}