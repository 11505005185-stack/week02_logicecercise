<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

foreach ($requests as $r) {
    echo make_reference(
        $r['id'],
        $r['dzongkhag'],
        $r['submitted']
    ) . PHP_EOL;
}

// Test calls
echo PHP_EOL;
echo make_reference(2, ' paro ', '2026-09-20') . PHP_EOL;
echo make_reference(6, 'Bumthang', '2026-10-03') . PHP_EOL;
echo make_reference(1, 'Thimphu', '2026-09-14') . PHP_EOL;

// Decision:
// The requested format is four digits for normal IDs. If the ID is 12345,
// keeping all digits is safer than cutting off a digit, because cutting it
// could create a duplicate reference.
