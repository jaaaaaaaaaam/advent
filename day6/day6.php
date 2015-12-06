<?php
ini_set('memory_limit', '1G');

$input = file('i');

$x=$y=0;
$max=999;
while ($x <= $max) {
    while ($y <= $max) {
        $lights[$x][$y]['brightness'] = 0;
        $lights[$x][$y]['state'] = 0;
        $y++;
    }
    $y=0;
    $x++;
}

foreach ($input as $instruction) {
    preg_match('/([a-z|\s]*) (\d{1,},\d{1,}) through (\d{1,3},\d{1,3})/', $instruction, $matches);
    $x = explode(',', $matches[2]);
    $y = explode(',', $matches[3]);
    $xfrom = $x[0];
    $xto = $y[0];
    $yfrom = $x[1];
    $yto = $y[1];
    //echo $matches[1].PHP_EOL;
    switch ($matches[1]) {
        case 'turn on':
            while ($xfrom <= $xto) {
                while ($yfrom <= $yto) {
                    $lights[$xfrom][$yfrom]['brightness'] = $lights[$xfrom][$yfrom]['brightness']+1;
                    $lights[$xfrom][$yfrom]['state'] = 1;
                    $yfrom++;
                }
                $yfrom = $x[1];
                $xfrom++;
            }
            break;
        case 'turn off':
            while ($xfrom <= $xto) {
                while ($yfrom <= $yto) {
                    if ($lights[$xfrom][$yfrom]['brightness'] > 0) {
                        $lights[$xfrom][$yfrom]['brightness'] = $lights[$xfrom][$yfrom]['brightness']-1;
                    }
                    $lights[$xfrom][$yfrom]['state'] = 0;
                    $yfrom++;
                }
                $yfrom = $x[1];
                $xfrom++;
            }
            break;
        default:
            while ($xfrom <= $xto) {
                while ($yfrom <= $yto) {
                    $lights[$xfrom][$yfrom]['brightness'] = $lights[$xfrom][$yfrom]['brightness']+2;
                    if (!array_key_exists($xfrom, $lights)) {
                        $lights[$xfrom][$yfrom]['state'] = 1;
                    } elseif (!array_key_exists($yfrom, $lights[$xfrom])) {
                        $lights[$xfrom][$yfrom]['state'] = 1;
                    } else {
                        ($lights[$xfrom][$yfrom]['state'] == 1) ? $lights[$xfrom][$yfrom]['state'] = 0 : $lights[$xfrom][$yfrom]['state'] = 1;
                    }
                    $yfrom++;
                }
                $yfrom = $x[1];
                $xfrom++;
            }
    }
}

$count = 0;
$bright = 0;
$x = 0;

while ($x <= $max) {
    while ($y <= $max) {
        $bright = $bright + $lights[$x][$y]['brightness'];
        if ($lights[$x][$y]['state'] == 1) {
            $count += 1;
        }
        $y++;
    }
    $y=0;
    $x++;
}

echo "Total On: $count $bright";
