<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Streamer;
use Captbaritone\TranscodeToMp3Stream\HeaderBuilder;
use Captbaritone\TranscodeToMp3Stream\Transcoder;
use Captbaritone\TranscodeToMp3Stream\AudioInspector;
use Captbaritone\TranscodeToMp3Stream\TranscodedSizeEstimator;

class Mp3Stream
{

    protected $transcoder;
    protected $streamer;
    protected $headerBuilder;
    protected $audioInspector;
    protected $transcodedSizeEstimator;

    public function __construct($transcoder = false, $streamer = false, $headerBuilder = false, $audioInspector = false, $transcodedSizeEstimator = false)
    {
        $this->transcoder = $transcoder ?: new Transcoder();
        $this->streamer = $streamer ?: new Streamer();
        $this->headerBuilder = $headerBuilder ?: new HeaderBuilder();
        $this->audioInspector = $audioInspector ?: new AudioInspector();
        $this->transcodedSizeEstimator = $transcodedSizeEstimator ?: new TranscodedSizeEstimator();
    }

    public function output($sourceMedia, $outputFilename = 'test.mp3', $kbps = 128, $start = 0, $end = 0)
    {

        $endTime = $end ?: $this->audioInspector->getLength($sourceMedia);
        $length = $endTime - $start;

        $cmd = $this->transcoder->command($sourceMedia, $kbps, $start, $length);

        $byteGoal = $this->transcodedSizeEstimator->estimatedBytes($length, $kbps);

        $this->headerBuilder->putHeader($outputFilename, $byteGoal);

        $this->streamer->outputStream($cmd, $byteGoal);
    }
}
