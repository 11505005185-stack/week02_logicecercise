<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Pending means Submitted or Under review.
$counts = [];

foreach ($requests as $r) {
    if ($r['status'] === 'Submitted' || $r['status'] === 'Under review') {
        $place = ucfirst(strtolower(trim($r['dzongkhag'])));

        if (!isset($counts[$place])) {
            $counts[$place] = 0;
        }

        $counts[$place]++;
    }
}

// Find the highest count without using max().
$highest = 0;

foreach ($counts as $place => $count) {
    if ($count > $highest) {
        $highest = $count;
    }
}

echo "Busiest: ";

$winners = [];
foreach ($counts as $place => $count) {
    if ($count === $highest) {
        $winners[] = $place;
    }
}

echo implode(', ', $winners) . " ($highest pending)" . PHP_EOL;

// Tidying names is important because 'paro' and 'Paro' must be treated
// as the same place. Without normalising the names, they could be counted
// as two different Dzongkhags.
