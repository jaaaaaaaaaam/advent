<?php
$in = "1321131112";
$count = 50;

while ($count--) {
    $in = preg_replace_callback('#(.)\1*#', function ($x) {
        return strlen($x[0]).$x[0][0];
    }, $in);
    if ($count == 10) {
        $o = strlen($in);
    }
}
echo $o.' '.strlen($in);
