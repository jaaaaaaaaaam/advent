<?php 

$i = file_get_contents('i');
$x = $rx = $sx = $y = $ry = $sy = 0;
foreach (str_split($i) as $n => $dir) {
    switch ($dir) {
        case '^':
            $sx++;
            ($n % 2 == 0) ? $x++ : $rx++;
            break;
        case '<':
            $sy--;
            ($n % 2 == 0) ? $y-- : $ry--;
            break;
        case '>':
            $sy++;
            ($n % 2 == 0) ? $y++ : $ry++;
            break;
        default:
            $sx--;
            ($n % 2 == 0) ? $x-- : $rx--;
    }
    $arr[3][$n] = "$sx,$sy";
    ($n % 2 == 0) ? $arr[0][$n] = "$x,$y" : $arr[1][$n] = "$rx,$ry";
}

echo 'Santa: '. (count(array_unique($arr[3])) + 1) .PHP_EOL;
echo "Santa + Robot: ". (count(array_unique(array_merge($arr[0], $arr[1]))));