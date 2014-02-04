<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Pipe;

class Transcoder
{

    public function command($sourceMedia, $kbps, $start, $end)
    {
        $format = 'mp3';
        $length = $end - $start;
        $sourceMedia = escapeshellarg($sourceMedia);
        $kbps = escapeshellarg("{$kbps}k");

        $haveStart = (bool) $start;
        $haveEnd = (bool) $end;

        $start = escapeshellarg($start);
        $end = escapeshellarg($end);

        $args = array();
        $args[] = "ffmpeg";
        if($haveStart) $args[] = "-ss {$start}";
        if($haveEnd) $args[] = "-t {$end}";
        $args[] = "-i {$sourceMedia}";
        $args[] = "-b:a {$kbps}";
        $args[] = "-minrate {$kbps}";
        $args[] = "-maxrate {$kbps}";
        $args[] = "-bufsize 64k";
        $args[] = "-f {$format}";
        $args[] = "-map_metadata -1";
        $args[] = " - 2>/dev/null"; // Pass the result to stdout
        return implode(' ', $args);
    }

}
