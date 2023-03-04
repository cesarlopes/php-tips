<?php

$grades = [
    [
        'student' => 'Cesar',
        'grade' => 10,
    ],
    [
        'student' => 'Pedro',
        'grade' => 6,
    ],
    [
        'student' => 'Samuel',
        'grade' => 9,
    ],
];

function sortGrades(array $grade1, array $grade2): int
{
    return $grade1['nota'] <=> $grade2['nota'];
}

usort($grades, 'sortGrades');
var_dump($grades);