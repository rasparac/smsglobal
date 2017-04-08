<?php

    require_once __DIR__ . '/Connection.php';
    require_once  __DIR__ . '/Query.php';

    $connection = Connection::getInstance();

    $Q = new Query($connection, 'smsglobal_test');

    $results = $Q->select()->get();

    $sanitize = [
        'name' => FILTER_SANITIZE_STRING | FILTER_SANITIZE_SPECIAL_CHARS,
        'age' => FILTER_SANITIZE_NUMBER_INT,
        'job_title' => FILTER_SANITIZE_STRING | FILTER_SANITIZE_SPECIAL_CHARS
    ];

    $input = [
        "name" => "<?php echo 'user'",
        "age" => "23",
        "job_title" => "tester"
    ];

    $obj = $Q->insert(
        $input,
        $sanitize
    );

    foreach ($results as $result) {
        echo "id: " . $result->id . "<br>";
        echo "name: " . $result->name . "<br>";
        echo "age: " . $result->age . "<br>";
        echo "job_title: " . $result->job_title . "<br>";
        echo "-------------------------------- <br>";
    }