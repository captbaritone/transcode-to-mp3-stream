<?php namespace Captbaritone\TranscodeToMp3Stream;

class TimeCalculator
{

    private $minutesPerHour = 60;
    private $secondsPerMinute = 60;
    private $framesPerSecond = 75;

    public function diffInSeconds($a, $b)
    {
        return abs($this->lengthInSeconds($a) - $this->lengthInSeconds($b));
    }

    public function lengthInSeconds($time)
    {
        $units = $this->parseTime($time);

        $seconds = $units['frames'] / $this->framesPerSecond +
                   $units['seconds'] +
                   ($units['minutes'] * $this->secondsPerMinute) +
                   ($units['hours'] * $this->secondsPerMinute * $this->minutesPerHour);

        return $seconds;
    }

    private function parseTime($time)
    {
        list($hours, $minutes, $seconds, $frames) = explode(':', $time);

        return array(
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds,
            'frames' => $frames,
        );
    }
}
