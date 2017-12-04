<?php

$allDists = $dists = $cities = [];

foreach (file('i') as $line) {
    preg_match('/^(\S+) to (\S+) = (\d+)$/', $line, $matches);
    list(, $cityFrom, $cityTo, $dist) = $matches;
    array_push($cities, $cityFrom, $cityTo);

    if (!isset($dists[$cityFrom])) {
        $dists[$cityFrom] = [];
    }
    if (!isset($dists[$cityTo])) {
        $dists[$cityTo] = [];
    }
    $dists[$cityFrom][$cityTo] = $dists[$cityTo][$cityFrom] = $dist;
}

$perms = permutations(array_values(array_unique($cities)));

foreach ($perms as $perm) {
    $total = 0;
    for ($i=0; $i<count($perm)-1; $i++) {
        $total += $dists[$perm[$i]][$perm[$i+1]];
    }
    array_push($allDists, $total);
}

echo "min : " . min($allDists) . "\n";
echo "max : " . max($allDists) . "\n";


function permutations($items, $perms = [])
{
    if (empty($items)) {
        $return = array($perms);
    } else {
        $return = array();
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            $return = array_merge($return, permutations($newitems, $newperms));
        }
    }
    return $return;
}
