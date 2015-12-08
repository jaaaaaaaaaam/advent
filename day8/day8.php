<?php

$charLength = 0;
$dataLength = 0;
$p2Length = 0;
foreach (file('i') as $data) {
    $charLength += strlen($data);
    $p2Length += strlen('"'.addslashes($data).'"');
    $data = stripslashes(preg_replace('/\\\x([a-f0-9A-F]{2})/', 's', $data));
    $dataLength += strlen(preg_replace('/"(.*)"/', '$1', $data));
}
echo ($charLength-$dataLength)." ".($p2Length-$charLength).PHP_EOL;
