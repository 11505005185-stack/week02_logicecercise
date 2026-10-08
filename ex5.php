<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$moves = [
    ['Submitted', 'Under review'],
    ['Submitted', 'Approved'],
    ['Under review', 'Rejected'],
    ['Approved', 'Submitted'],
    ['Rejected', 'Submitted'],
    ['Closed', 'Submitted'],
];

foreach ($moves as [$from, $to]) {
    $result = can_move($from, $to) ? 'Allowed' : 'Blocked';
    echo "$from → $to: $result" . PHP_EOL;
}

echo PHP_EOL . "Role tests:" . PHP_EOL;

$roleTests = [
    ['officer', 'Under review', 'Approved'],
    ['approver', 'Under review', 'Approved'],
    ['requester', 'Rejected', 'Submitted'],
];

foreach ($roleTests as [$role, $from, $to]) {
    $result = can_move_as($role, $from, $to) ? 'true' : 'false';
    echo "can_move_as('$role', '$from', '$to'): $result" . PHP_EOL;
}

// An array is better than a long if/elseif chain because the workflow rules
// are stored as data. They are easier to read, update, reuse and extend.
