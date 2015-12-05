<?php

$input = file('i');
$n = $m = 0;
foreach ($input as $string) {
	if (preg_match('#(?=.*(.)\1)(?=(.*[aeiou]){3})#', $string) && !preg_match('#(ab|cd|pq|xy)#', $string)) {
		$n++;
	}
	if (preg_match('#(?=.*(..).*\1)(?=.*(.).\2)#',$string)) {
		$m++;
	}
}

echo "$n, $m";