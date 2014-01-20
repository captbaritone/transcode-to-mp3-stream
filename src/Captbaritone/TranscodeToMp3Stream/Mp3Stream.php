<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Streamer;
use Captbaritone\TranscodeToMp3Stream\HeaderBuilder;
use Captbaritone\TranscodeToMp3Stream\TimeCalculator;

class Mp3Stream
{

    protected $transcoder;
    protected $streamer;
    protected $headerBuilder;
    protected $timeCalculator;
    protected $transcodedSizeEstimator;

    public function __construct($transcoder = false, $streamer = false, $headerBuilder = false, $timeCalculator = false, $transcodedSizeEstimator = false)
    {
        $this->transcoder = $transcoder ?: new Transcoder();
        $this->streamer = $streamer ?: new Streamer();
        $this->headerBuilder = $headerBuilder ?: new HeaderBuilder();
        $this->timeCalculator = $timeCalculator ?: new TimeCalculator();
        $this->transcodedSizeEstimator = $transcodedSizeEstimator ?: new TranscodedSizeEstimator();
    }

    public function output($sourceMedia,
                           $outputFilename = 'test.mp3',
                           $kbps = 128,
                           $start = NULL,
                           $end = NULL)
    {
        if($start === NULL) $start = '00:00:00:00';

        // XXX Find length of file
        if($end === NULL) $end = '00:01:00:00';

        $length = $this->timeCalculator->diffInSeconds($end, $start);

        $cmd = $this->transcoder->command($sourceMedia, $kbps, $start, $end);

        $byteGoal = $this->transcodedSizeEstimator->estimatedBytes($length, $kbps);

        $this->headerBuilder->putHeader($outputFilename, $byteGoal);

        $this->streamer->outputStream($cmd, $byteGoal);
    }
}
