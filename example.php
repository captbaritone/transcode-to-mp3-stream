<?php

use Captbaritone\TranscodeToMp3Stream\Mp3Stream;

require_once __DIR__ . '/vendor/autoload.php';

$mp3Stream = new Mp3Stream();

$sourceMedia = 'example.flac';
$outputFilename = 'example.mp3';
$kbps = 128;
$start = 3.6;
$end = 7.3;

$mp3Stream->output($sourceMedia, $outputFilename, $kbps, $start, $end);

