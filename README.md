# Week 2 Logic Exercises - Solved

This folder contains the solutions for the RIM Full Stack Web Development
Week 2 Logic Exercises.

## Files

- `data.php` - the 8 records supplied in the worksheet.
- `helpers.php` - reusable functions for references, waiting bands, CID validation and status rules.
- `ex1.php` - Predict the output.
- `ex2.php` - Busiest Dzongkhag.
- `ex3.php` - Reference numbers.
- `ex4.php` - Waiting-time alert.
- `ex5.php` - Status rules and role permissions.
- `ex6.php` - Debugging the five bugs.
- `ex7.php` - Duplicate and invalid CIDs.

## How to run

Make sure PHP is installed, then open a terminal in this folder and run:

```bash
php ex1.php
php ex2.php
php ex3.php
php ex4.php
php ex5.php
php ex6.php
php ex7.php
```

## Expected key results

- Exercise 1: `none | 0`, `19`, `BAC`, `4ro`
- Exercise 2: `Busiest: Paro (2 pending)`
- Exercise 4: `3 overdue · 1 follow up · 1 on time`
- Exercise 6: `5`
- Exercise 7: duplicate CIDs `10101001234` and `11205002345`; invalid CIDs are requests 2 and 6.

## Note

The solutions follow the exercise rules in the supplied worksheet, including
using loops instead of `max()`, `arsort()`, or `array_count_values()` where prohibited.
