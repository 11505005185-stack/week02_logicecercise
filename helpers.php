<?php
declare(strict_types=1);

/**
 * Create a reference such as PAR-2026-0002.
 */
function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    $code = strtoupper(substr(trim($dzongkhag), 0, 3));
    $year = date('Y', strtotime($submitted));

    // The format is designed for four-digit IDs. IDs above 9999
    // will naturally use more than four digits rather than being cut off.
    $formattedId = str_pad((string)$id, 4, '0', STR_PAD_LEFT);

    return sprintf('%s-%s-%s', $code, $year, $formattedId);
}

/**
 * Return the waiting-time band.
 */
function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    } elseif ($days <= 7) {
        return 'On time';
    } elseif ($days <= 14) {
        return 'Follow up';
    } else {
        return 'Overdue';
    }
}

/**
 * Check whether a CID is exactly 11 digits.
 */
function is_valid_cid(string $cid): bool
{
    return preg_match('/^\d{11}$/', $cid) === 1;
}

/**
 * Workflow rules.
 */
function workflow_rules(): array
{
    return [
        'Submitted' => ['Under review'],
        'Under review' => ['Approved', 'Rejected'],
        'Rejected' => ['Submitted'],
        'Approved' => [],
    ];
}

/**
 * Check whether a status transition is allowed.
 */
function can_move(string $from, string $to): bool
{
    $rules = workflow_rules();

    // ?? prevents an Undefined array key warning for unknown statuses.
    $allowed = $rules[$from] ?? [];

    return in_array($to, $allowed, true);
}

/**
 * Check whether a role is allowed to make a transition.
 * The role determines which destination statuses are permitted,
 * while can_move() still checks the workflow itself.
 */
function can_move_as(string $role, string $from, string $to): bool
{
    $roleRules = [
        'officer' => ['Under review'],
        'approver' => ['Approved', 'Rejected'],
        'requester' => ['Submitted'],
    ];

    $allowedDestinations = $roleRules[$role] ?? [];

    return in_array($to, $allowedDestinations, true)
        && can_move($from, $to);
}
