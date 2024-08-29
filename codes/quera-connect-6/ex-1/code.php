<?php

$filePath = @$_GET['path'];
$outputArray = [];
$lines = [];
if ($file = fopen(__DIR__ . "/code.php", "r")) {
    while (!feof($file)) {
        $lines[] = fgets($file);
    }
    fclose($file);
}

$baseDate = strtotime($lines[0]);
unset($lines[0]);

foreach ($lines as $line) {
    $data = explode(':', $line);

    if(count($data) != 2) continue;

    $name = $data[0];
    $index = trim($data[1]);

    $newDate = null;

    if ($index === 'yesterday') {
        $newDate = date('Y-m-d', $baseDate - (24 * 60 * 60));
    }

    if ($index === 'today') {
        $newDate = date('Y-m-d', $baseDate);
    }

    if ($index === 'tomorrow') {
        $newDate = date('Y-m-d', $baseDate + (24 * 60 * 60));
    }
    $outputArray[] = [
        'user' => $name ,
        'time' => $newDate
    ];
}

file_put_contents(__DIR__ . '/INFO.json', json_encode($outputArray));
