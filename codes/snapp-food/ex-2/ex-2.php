<?php

const PHONE_PATTERN = "/(^09[0-9]{9}$)|(^\+9891[0-9]{8}$)/";


$phoneNumbersText = "In shomareye mane: 09101007567 vali behtare +989101007567 ro save koni. In 9111231234 va0914513 kar nemikonan.";
function findPhoneNumbers(string $text): array
{
    $newData = [];
    $data = array_filter(explode(' ', $text), fn($string) => preg_match(PHONE_PATTERN, $string));
    foreach ($data as $value) {
        $newData[] = $value;
    }
    return $newData;
}

const HASHTAG_PATTERN = '/^#[a-zA-Z0-9]{2,}$/';
$hashTagText = "Salam #goodMOrning khoobi#to #4yourlove #bi-man";

function findHashtags(string $text): array
{
    $newData = [];
    $data =  array_filter(explode(' ', $text), fn($string) => preg_match(HASHTAG_PATTERN, $string));
    foreach ($data as $value) {
        $newData[] = $value;
    }
    return $newData;
}

const EMAIL_PATTERN = '/\b[a-zA-Z0-9_.]+@[a-zA-Z0-9]+\.[a-zA-Z]{3}\b/';
$emailText = "Soalatono az info_test@quera.ir ya info@Quera123.com ya test_#23@alaki.core beporsid";
function boldEmails(string $text): string
{
    $boldedValues = preg_grep(EMAIL_PATTERN, explode(' ', $text));
    return implode(' ', array_map(function ($string) use ($boldedValues) {
            if (in_array($string, $boldedValues)) return "<b>{$string}</b>";
            return $string;
        }, explode(' ', $text))
    );
}

print_r(findHashtags($hashTagText));
