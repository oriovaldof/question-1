<?php
/**
 * @abstract controller function, returns the value according to the type informed
 * @param [type] $value
 * @param string $typeConvertion ( I = integer or R = Romans)
 * @return void
 */
function romans($value, $typeConvertion = "I")
{
    $arType = ['I' => 'Integer', 'R' => 'Romans'];
    $typeConvertion = strtoupper($typeConvertion);

    if (!array_key_exists($typeConvertion, $arType)) die('Enter type I = integer or R = Romans');

    $Converted = '';
    if ($typeConvertion == "R") {

        if(!is_numeric($value)) die ('type an integer');

        $Converted = convertRomans($value);
    } else {
        $Converted = convertInteger($value);
    }
    echo " The Amount {$value} converted into {$arType[$typeConvertion]} is {$Converted} ";
}
/**
 * @abstract Responsible function to convert Roman numbers to integers
 * @param [type] $value
 * @return void
 */
function convertInteger($value)
{
    $arRomans = ['0' => '', '1' => 'I', '2' => 'V', '3' => 'X', '4' => 'L', '5' => 'C', '6' => 'D', '7' => 'M'];
    $arValues = ['0' => 0, '1' => 1, '2' => 5, '3' => 10, '4' => 50, '5' => 100, '6' => 500, '7' => 1000];
    $sum = 0;
    $previous = 0;
    $text = '';
    for ($i = 0; $i < strlen($value); $i++) {
        $text = strtoupper($value[$i]);

        if (!in_array($text, $arRomans)) die('The informed value does not belong to the Roman numerals');

        for ($j = 0; $j <= 7; $j++) {
            if ($text == $arRomans[$j]) {
                $sum = $sum + $arValues[$j];
                if ($previous < $arValues[$j]) {
                    $sum = $sum - ($previous * 2);
                }
                $previous =  $arValues[$j];
            }
        }
    }
    return $sum;
}

/**
 * @abstract  Responsible function for converting Integers to Romans
 * @param [type] $value
 * @return void
 */
function convertRomans($value)
{
    if ($value <= 0 || $value > 3999) {
        return $value;
    }

    $n = (int)$value;
    $y = '';

    // Nivel 1
    while (($n / 1000) >= 1) {
        $y .= 'M';
        $n -= 1000;
    }
    if (($n / 900) >= 1) {
        $y .= 'CM';
        $n -= 900;
    }
    if (($n / 500) >= 1) {
        $y .= 'D';
        $n -= 500;
    }
    if (($n / 400) >= 1) {
        $y .= 'CD';
        $n -= 400;
    }

    // Nivel 2
    while (($n / 100) >= 1) {
        $y .= 'C';
        $n -= 100;
    }
    if (($n / 90) >= 1) {
        $y .= 'XC';
        $n -= 90;
    }
    if (($n / 50) >= 1) {
        $y .= 'L';
        $n -= 50;
    }
    if (($n / 40) >= 1) {
        $y .= 'XL';
        $n -= 40;
    }

    // Nivel 3
    while (($n / 10) >= 1) {
        $y .= 'X';
        $n -= 10;
    }
    if (($n / 9) >= 1) {
        $y .= 'IX';
        $n -= 9;
    }
    if (($n / 5) >= 1) {
        $y .= 'V';
        $n -= 5;
    }
    if (($n / 4) >= 1) {
        $y .= 'IV';
        $n -= 4;
    }

    // Nivel 4
    while ($n >= 1) {
        $y .= 'I';
        $n -= 1;
    }

    return $y;
}

/*---------------------------------------------------------------------------------------------------------------*/;
$value = "MMMCDXXI";
romans($value, 'I');

$value = "3421";
romans($value, 'R');
