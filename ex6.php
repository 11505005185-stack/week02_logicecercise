<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

function count_pending(array $requests): int
{
    $total = 0;

    // BUG 1 fixed: start at index 0 so the first request is included.
    for ($i = 0; $i < count($requests); $i++) {

        // BUG 2 fixed: the key is lowercase 'status'.
        $status = $requests[$i]['status'];

        // BUG 3 fixed: use comparison (===), not assignment (=).
        if ($status === 'Submitted' || $status === 'Under review') {

            // BUG 4 fixed: actually add 1 to $total.
            $total++;
        }
    }

    // BUG 5 fixed: return the calculated total.
    return $total;
}

echo count_pending($requests) . PHP_EOL;

// Bug log:
// 1. Loop started at 1 -> request 1 was skipped. Fix: start at 0.
// 2. 'Status' used -> wrong array key. Fix: use 'status'.
// 3. '=' used -> assignment instead of comparison. Fix: use '==='.
// 4. '$total + 1' did not change the variable. Fix: use '$total++'.
// 5. Function had no return statement. Fix: return $total.
//
// Expected output: 5
