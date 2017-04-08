<?php

    require_once __DIR__ . '/../zadatak_2/Connection.php';
    require_once __DIR__ . '/../zadatak_2/Query.php';


    $connection = Connection::getInstance();

    $q = new Query($connection, 'a_b_testing');

    $results = $q->select()->get();
    $designs = [];
    $lastValue = 0;

    function inRange($number, $min, $max) {
        return $number > $min && $number <= $max;
    }

    foreach ($results as $result) {
        $designs[] = [
            'id' => $result->id,
            'redirect' => $result->design_name,
            'min' => $lastValue,
            'max' => $lastValue + $result->split_percent
        ];

        $lastValue += $result->split_percent;
    }

    $randomNumber = random_int(0, 100);

    foreach ($designs as $design) {
        if (inRange($randomNumber, $design['min'], $design['max'])) {
            //redirect to specific design
        }
    }
