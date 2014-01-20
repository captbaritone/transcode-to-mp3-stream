<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\TimeCalculator;

class TimeCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testLengthInSeconds()
    {
        $calc = new TimeCalculator();

        $seconds = $calc->lengthInSeconds('01:01:01:15');

        $this->assertEquals($seconds, 3661.2);
    }

    public function testDiffInSeconds()
    {
        $calc = new TimeCalculator();

        $seconds = $calc->diffInSeconds('01:01:01:15', '00:01:01:00');

        $this->assertEquals($seconds, 3600.2);
    }
}
