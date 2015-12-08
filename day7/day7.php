<?php
$i = file('i');
$z = [];
foreach ($i as $s) {
    $r = explode(' -> ', $s);
    $z[trim($r[1])] = trim($r[0]);
}
/* PART 2 (REMOVE THIS LINE FOR PART 1) */
$z['b'] = 3176;
function resolve($op, &$z)
{
    $ops = explode(' ', $op);
    if (count($ops) === 1) {
        if (isset($z[$ops[0]]) && !is_numeric($ops[0])) {
            return $z[$ops[0]] = (int) resolve($z[$ops[0]], $z);
        }
        return $z[$ops[0]] = (int) $ops[0];
    }
    if (count($ops) === 2) {
        return $z[$ops[1]] = ~ (int) resolve($ops[1], $z);
    }
    $a = resolve($ops[0], $z);
    $b = resolve($ops[2], $z);
    switch ($ops[1]) {
        case 'AND':
            $r = $a & $b;
            break;
        case 'OR':
            $r = $a | $b;
            break;
        case 'LSHIFT':
            $r = $a << $b;
            break;
        case 'RSHIFT':
            $r = $a >> $b;
            break;
        default:
            throw new Exception('Unknown op: ' . $ops[1]);
    }
    return (int) $r;
}
echo resolve($z['a'], $z);
