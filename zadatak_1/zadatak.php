<?php

    //init array of random values
    $randomElements = [];
    //min and max values for the array
    $min = 1;
    $max = 500;

    //fill the array with random values
    for($i = 0; $i < $max; $i++) {
        $randomElements[] = random_int($min, $max);
    }

    //sum before discarding
    $sumBeforeUnset = array_sum($randomElements);

    //discard one random element
    unset($randomElements[array_rand($randomElements, 1)]);

    //sum after discarding
    $sumAfterUnset = array_sum($randomElements);

    //print removed element
    //removed element is the rest of the sums before and after discarding
    echo $sumBeforeUnset - $sumAfterUnset;