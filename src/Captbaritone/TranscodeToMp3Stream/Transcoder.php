<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Pipe;

class Transcoder
{

    public function command($sourceMedia, $kbps, $start, $duration)
    {
        $format = 'mp3';
        $sourceMedia = escapeshellarg($sourceMedia);
        $kbps = escapeshellarg("{$kbps}k");

        $haveStart = (bool) $start;
        $haveDuration = (bool) $duration;

        $start = escapeshellarg($start);
        $duration = escapeshellarg($duration);

        $args = array();
        $args[] = "exec";
        $args[] = "avconv";
        if($haveStart) $args[] = "-ss {$start}";
        if($haveDuration) $args[] = "-t {$duration}";
        $args[] = "-i {$sourceMedia}";
        $args[] = "-ab {$kbps}";
        $args[] = "-minrate {$kbps}";
        $args[] = "-maxrate {$kbps}";
        $args[] = "-bufsize 64k";
        $args[] = "-f {$format}";
        $args[] = "-map_metadata -1";
        $args[] = " - 2>/dev/null"; // Pass the result to stdout
        return implode(' ', $args);
    }

}
