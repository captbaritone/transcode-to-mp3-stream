<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\TranscodedSizeEstimator;

class TranscodedSizeEstimatorTest extends \PHPUnit_Framework_TestCase
{
    public function testEstimatedBytes()
    {
        $estimator = new TranscodedSizeEstimator();

        $estimate = $estimator->estimatedBytes(1, 128);

        $this->assertEquals(16000, $estimate);
    }

    public function testEstimatedBytesAreWholeNumber()
    {
        $estimator = new TranscodedSizeEstimator();

        $estimate = $estimator->estimatedBytes(1.0001, 128);

        $this->assertEquals(16002, $estimate);
    }
}
