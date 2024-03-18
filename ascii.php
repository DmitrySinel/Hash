<?php

$ascii = [
    'А' => 128,
    'Б' => 129,
    'В' => 130,
    'Г' => 131,
    'Д' => 132,
    'Е' => 133,
    'Ж' => 134,
    'З' => 135,
    'И' => 136,
    'Й' => 137,
    'К' => 138,
    'Л' => 139,
    'М' => 140,
    'Н' => 141,
    'О' => 142,
    'П' => 143,
    'Р' => 144,
    'С' => 145,
    'Т' => 146,
    'У' => 147,
    'Ф' => 148,
    'Х' => 149,
    'Ц' => 150,
    'Ч' => 151,
    'Ш' => 152,
    'Щ' => 153,
    'Ъ' => 154,
    'Ы' => 155,
    'Ь' => 156,
    'Э' => 157,
    'Ю' => 158,
    'Я' => 159,

    'а' => 160,
    'б' => 161,
    'в' => 162,
    'г' => 163,
    'д' => 164,
    'е' => 165,
    'ж' => 166,
    'з' => 167,
    'и' => 168,
    'й' => 169,
    'к' => 170,
    'л' => 171,
    'м' => 172,
    'н' => 173,
    'о' => 174,
    'п' => 175,
    'р' => 224,
    'с' => 225,
    'т' => 226,
    'у' => 227,
    'ф' => 228,
    'х' => 229,
    'ц' => 230,
    'ч' => 231,
    'ш' => 232,
    'щ' => 233,
    'ъ' => 234,
    'ы' => 235,
    'ь' => 236,
    'э' => 237,
    'ю' => 238,
    'я' => 239
];

function myXor(string $a, string $b): string
    {
    $resultNumber = [];
    if(strlen($a) < 8){
        $a = sprintf("%08d", $a);
    }
    if(strlen($b) < 8){
        $b = sprintf("%08d", $b);
    }
    $arrA = array_reverse(str_split($a, 1));
    $arrB = array_reverse(str_split($b, 1));
    if(count($arrB) == 9){
        $arrA[8] = '0';
    }
    for($z = 0; $z < count($arrB); $z++)
    {
        if($arrA[$z] !== $arrB[$z]){
            $resultNumber[$z] = 1;
        }
        if($arrA[$z] == $arrB[$z]){
            $resultNumber[$z] = 0;
        }
    }
    return implode(array_reverse($resultNumber));
}

function addOldValue(string $key, mixed $value)
{
    $_SESSION['oldNum'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['oldNum'][$key] ?? '';
    unset($_SESSION['oldNum'][$key]);
    return $value;
}