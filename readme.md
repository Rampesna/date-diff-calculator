# Date Diff Calculator

This package is a simple date diff calculator. It calculates the difference between two dates and returns the result in
a human readable format.

[![Total Downloads](https://img.shields.io/packagist/dt/rampesna/date-diff-calculator.svg)](https://packagist.org/packages/rampesna/date-diff-calculator)
![GitHub repo size](https://img.shields.io/github/repo-size/rampesna/date-diff-calculator)
![Build](https://img.shields.io/badge/build-passing-brightgreen)

## Requirements

- PHP >= 8.0

## Installation

```bash
composer require rampesna/date-diff-calculator
```

## Usage

### Controller

```php

use Rampesna\DateDiffCalculator;

class ExampleController extends Controller
{
    public function index(Request $request)
    {
        $permitStartDate = '2023-09-20 09:00:00';
        $permitEndDate = '2023-10-10 18:00:00';
    
        $dailyWorkingHours = 8;
    
        $dateDiffCalculator = new DateDiffCalculator(
            $dailyWorkingHours,
            $permitStartDate,
            $permitEndDate
        );
    
        $minutes = $dateDiffCalculator->calculate();
        
        return response()->json(
            $dateDiffCalculator->getDurationForHuman($minutes)
        );
    }
}
```

## License

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
