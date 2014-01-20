<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\Mp3Stream;

use \Mockery as m;

class Mp3StreamTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testMp3Stream()
    {
        $sourceMedia = 'filename.flac';
        $outputFilename = 'testing.mp3';
        $kbps = 128;
        $start = 'start';
        $end = 'end';
        $byteGoal = 100;

        $command = 'foo';

        $transcoder = m::mock('Transcoder');
        $transcoder->shouldReceive('command')
            ->with($sourceMedia, $kbps, $start, $end)
            ->andReturn($command);

        $transcodedSizeEstimator = m::mock('TranscodedSizeEstimator');
        $transcodedSizeEstimator->shouldReceive('estimatedBytes')
            ->once()
            ->with(0, $kbps)
            ->andReturn($byteGoal);

        $streamer = m::mock('Streamer');
        $streamer->shouldReceive('outputStream')
            ->once()
            ->with($command, $byteGoal);

        $headerBuilder = m::mock('HeaderBuilder');
        $headerBuilder->shouldReceive('putHeader')
            ->once()
            ->with($outputFilename, $byteGoal);


        $timeCalculator = m::mock('TimeCalculator');
        $timeCalculator->shouldReceive('diffInSeconds')
            ->once()
            ->andReturn(0);

        $mp3Stream = new Mp3Stream(
            $transcoder,
            $streamer,
            $headerBuilder,
            $timeCalculator,
            $transcodedSizeEstimator
        );

        $mp3Stream->output($sourceMedia, $outputFilename, $kbps, $start, $end);

    }

}
