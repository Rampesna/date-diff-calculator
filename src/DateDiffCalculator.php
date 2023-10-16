<?php

namespace Rampesna;

//use Illuminate\Support\Carbon;

class DateDiffCalculator
{
    private $dailyWorkingHours;
    private $startDate;
    private $endDate;

    public function __construct($dailyWorkingHours, $startDate, $endDate)
    {
        $this->dailyWorkingHours = $dailyWorkingHours;
        $this->startDate = new DateTransaction($startDate);
        $this->endDate = new DateTransaction($endDate);
    }

    public function calculate()
    {
        if ($this->startDate->isSameDay($this->endDate)) {
            return $this->calculateMinutesForSingleDay($this->startDate, $this->endDate);
        }

        $minutes = 0;

        $minutes += $this->calculateMinutesForSingleDay($this->startDate, $this->startDate->copy()->endOfDay());
        $minutes += $this->calculateMinutesForSingleDay($this->endDate->copy()->startOfDay(), $this->endDate);

        $currentDate = $this->startDate->copy()->addDay();

        while (!$currentDate->isSameDay($this->endDate)) {
            $minutes += $this->dailyWorkingHours * 60;
            $currentDate->addDay();
        }

        return $minutes;
    }

    private function calculateMinutesForSingleDay($start, $end)
    {
        $dailyWorkingMinutes = $this->dailyWorkingHours * 60;

        $minutesForDay = $start->diffInMinutes($end);

        return min($minutesForDay, $dailyWorkingMinutes);
    }

    public function getDurationForHuman($minutes)
    {
        $hours = intval($minutes / 60);
        $minutes -= ($hours * 60);
        $days = intval($hours / $this->dailyWorkingHours);
        $hours -= ($days * $this->dailyWorkingHours);

        return ($days != 0 ? $days . ' Gün' : '') .
            ($hours != 0 ? ' ' . $hours . ' Saat' : '') .
            ($minutes != 0 ? ' ' . $minutes . ' Dakika' : '');
    }
}
