<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$byCid = [];

foreach ($requests as $r) {
    $cid = $r['cid'];

    if (!isset($byCid[$cid])) {
        $byCid[$cid] = [];
    }

    $byCid[$cid][] = $r['id'];
}

// Print duplicate CIDs.
foreach ($byCid as $cid => $ids) {
    if (count($ids) > 1) {
        echo "Duplicate $cid: requests " . implode(', ', $ids) . PHP_EOL;
    }
}

echo PHP_EOL;

// Print invalid CIDs.
foreach ($requests as $r) {
    if (!is_valid_cid($r['cid'])) {
        echo "Invalid CID in request {$r['id']}: {$r['cid']}" . PHP_EOL;
    }
}

// A duplicate is not automatically an error. Two records may share a CID
// for a legitimate reason, so Karma should verify the records and investigate
// before deciding that it is an error.
