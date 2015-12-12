<?php

preg_match_all("/(-?\d+)+/", file('i')[0], $matches);

echo array_sum($matches[0]).PHP_EOL;

print part2(json_decode(file('i')[0]));

function part2($i)
{
    $total = 0;
    foreach ($i as $part) {
        if (is_array($part) || is_object($part)) {
            $total += part2($part);
        }

        if (is_numeric($part)) {
            $total += $part;
        }

        if (is_object($data) && is_string($part) && $part == "red") {
            return false;
        }
    }
    return $total;
}
