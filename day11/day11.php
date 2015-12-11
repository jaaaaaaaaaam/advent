<?php
$input = 'cqjxjnds';

function is_day11_valid($str)
{
    $arr = str_split($str);
    for ($i=0; $i<count($arr)-2; $i++) {
        if (ord($arr[$i+1]) === ord($arr[$i])+1 && ord($arr[$i+2]) === ord($arr[$i])+2) {
            return (1 !== preg_match("/[iol]/", $str))
                && (1 === preg_match("/(.)\\1.*(.)\\2/", $str));
        }
    }
    return false;
}

while (!is_day11_valid(++$input));
echo $input.PHP_EOL;
while (!is_day11_valid(++$input));
echo $input.PHP_EOL;
