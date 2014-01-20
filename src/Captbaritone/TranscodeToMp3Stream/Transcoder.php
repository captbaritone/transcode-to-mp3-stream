<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Pipe;

class Transcoder
{

    public function command($sourceMedia, $kbps, $start, $end)
    {
        $format = 'mp3';

        return "avconv -i '{$sourceMedia}' " .
                "-b:a {$kbps}k " . 
                "-minrate {$kbps}k " .
                "-maxrate {$kbps}k " .
                "-bufsize 64k " .
                "-f {$format} " . 
                "-map_metadata -1 " . 
                " - 2>/dev/null"; // Pass the result to stdout
    }
}
