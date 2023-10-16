<?php

namespace Rampesna;

class DateTransaction
{
    private $date;
    private $format = 'Y-m-d H:i:s';

    public function __construct($date)
    {
        if (is_string($date)) {
            $this->date = new \DateTime($date);
        } else {
            throw new \Exception("Invalid date format. Expected string.");
        }
    }

    public function isSameDay(DateTransaction $otherDate)
    {
        return $this->date->format('Y-m-d') == $otherDate->format('Y-m-d');
    }

    public function diffInMinutes(DateTransaction $otherDate)
    {
        $interval = $this->date->diff($otherDate->getInternalDate());
        return ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
    }

    public function addDay()
    {
        $this->date->modify('+1 day');
        return $this;
    }

    public function startOfDay()
    {
        $this->date->setTime(0, 0, 0);
        return $this;
    }

    public function endOfDay()
    {
        $this->date->setTime(23, 59, 59);
        return $this;
    }

    public function format($format = null)
    {
        return $this->date->format($format ?? $this->format);
    }

    public function getInternalDate()
    {
        return $this->date;
    }

    public function copy()
    {
        return new DateTransaction($this->format());
    }
}