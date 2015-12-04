<?php

$input = 'bgvyzdsv';

$n = 0;
$m = 0;

while (strpos(md5("$input$n"), "00000") !== 0) { ++$n; }
while (strpos(md5("$input$m"), "000000") !== 0) { ++$m; }

echo "$n $m";
