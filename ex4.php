<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$today = '2026-10-07';

$overdue = 0;
$followUp = 0;
$onTime = 0;

foreach ($requests as $r) {
    if ($r['status'] !== 'Submitted' && $r['status'] !== 'Under review') {
        continue;
    }

    $days = intdiv(
        strtotime($today) - strtotime($r['submitted']),
        86400
    );

    $band = wait_band($days);

    echo "#{$r['id']} " .
        trim($r['first']) . " {$r['last']} — " .
        "$days days — $band" . PHP_EOL;

    if ($band === 'Overdue') {
        $overdue++;
    } elseif ($band === 'Follow up') {
        $followUp++;
    } elseif ($band === 'On time') {
        $onTime++;
    }
}

echo "$overdue overdue · $followUp follow up · $onTime on time" . PHP_EOL;

// Edge tests: -1, 0, 7, 8, 14, 15
echo PHP_EOL . "Edge tests:" . PHP_EOL;
foreach ([-1, 0, 7, 8, 14, 15] as $days) {
    echo "$days => " . wait_band($days) . PHP_EOL;
}

// The important boundaries are checked directly so that 7 stays On time,
// 8 becomes Follow up, 14 stays Follow up, and 15 becomes Overdue.
