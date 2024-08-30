<?php


$oldStudents = json_decode(file_get_contents(__DIR__ . '/students.json'), true);


$newStudents = [];
foreach ($oldStudents as $student) {
    if (array_key_exists($student['id'], $newStudents)) continue;
    $newStudents[$student['id']] = [
        'bdate' => $student['bdate'],
        'name' => implode(' ', array_map(
                fn($nameEntity) => ucfirst($nameEntity),
                explode(' ', strtolower($student['name'])
                ))
        ),
        'age' => (string) date_diff(new DateTime($student['bdate']), new DateTime('2019/10/04'))->y
    ];
}

file_put_contents(__DIR__ . '/students_fixed.json', json_encode($newStudents));
