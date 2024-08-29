<?php

function randomText(int $wordsCount): string
{
    $words = [];
    for ($i = 0; $i < $wordsCount; $i++) {
        $words[] = randomWord();
    }
    return implode(" ", $words);
}

function randomWord(): string
{
    $vowels = ["a", "e", "i", "o", "u"];
    $consonants = [
        "b", "c", "d", "f", "g", "h", "j", "k", "l", "m",
        "n", "p", "r", "s", "t", "v", "w", "x", "y", "z"
    ];
    $string = "";
    $max = intdiv(rand(4, 8), 2);
    for ($i = 1; $i <= $max; $i++) {
        $string .= $consonants[array_rand($consonants)];
        $string .= $vowels[array_rand($vowels)];
    }

    return $string;
}

function estimateReadingTime(string $text): int
{
    str_replace([':', ';', ',', '!', '?', '.'], '', $text);
    return ceil(count(preg_split("/( )|(\t)|(\n)/", $text)) / 200);
}

echo estimateReadingTime(randomText(200)); // 1
echo '<br>';
echo estimateReadingTime(randomText(201)); // 2
echo '<br>';
echo estimateReadingTime(randomText(50)); // 1
echo '<br>';
echo estimateReadingTime(randomText(1895)); // 10
