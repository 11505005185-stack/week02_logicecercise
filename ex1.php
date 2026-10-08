<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Snippet A
$x = 0;
$label = $x ?: 'none';
$size = $x ?? 'none';

echo "Snippet A: $label | $size" . PHP_EOL;
// Reason: ?: uses the truthiness of 0, so it chooses 'none'.
// ?? only uses the right side when the left side is null or unset,
// so $size remains 0.

// Snippet B
$total = 0;
for ($i = 1; $i <= 10; $i++) {
    if ($i % 3 === 0) {
        continue;
    }

    if ($i > 7) {
        break;
    }

    $total += $i;
}

echo "Snippet B: $total" . PHP_EOL;
// Reason: 3 and 6 are skipped. The loop reaches 8 and breaks.
// Added values: 1 + 2 + 4 + 5 + 7 = 19.

// Snippet C
$m = ['b' => 2, 'a' => 1, 'c' => 3];
$out = '';

foreach ($m as $k => $v) {
    $up = $v > 1;
    $out .= $up ? strtoupper($k) : $k;
}

echo "Snippet C: $out" . PHP_EOL;
// Reason: b and c have values greater than 1, so their keys become B and C.
// The array keeps insertion order: b, a, c.

// Snippet D
$n = strlen(trim(' Paro '));
echo "Snippet D: " . $n . substr('Paro', -2) . PHP_EOL;
// Reason: trim(' Paro ') gives 'Paro', whose length is 4.
// substr('Paro', -2) gives 'ro'. Therefore the output is 4ro.
