<?php namespace Captbaritone\TranscodeToMp3Stream;

/**
 * Audio Inspector
 *
 * Inspect audio files using the ffprobe command line tool. Currently is only
 * used for getting the length of a media file
 *
 * @author Jordan Eldredge <jordaneldredge@gmail.com>
 **/
class AudioInspector
{

    public function getLength($file)
    {
        $file = escapeshellarg($file);
        $cmd = "avprobe -v quiet -show_format -show_streams {$file}  2>&1 | grep -m 1 'duration=' | grep -o '[0-9.]\+'";

        $output = exec($cmd);
        return $output;
    }

    /**
     * Modern Get Length
     *
     * REQUIRES ffmpeg 0.9, which we don't have yet.
     *
     * Get the lenght of an audio or video media file
     *
     * @param string $file path to the media file we are querying
     * @return float decimal length of $file in seconds
     * @author Jordan Eldredge <jordaneldredge@gmail.com>
     **/
    public function modernGetLength($file)
    {
        $json = $this->probe($file);
        return $json->streams[0]->duration;
    }

    /**
     * Probe
     *
     * REQUIRES ffmpeg 0.9, which we don't have yet.
     *
     * Get ffprobe's media information for a file using it's json output
     *
     * @param string $file path to the media file we are querying
     * @return obj ffprobe's media information
     * @author Jordan Eldredge <jordaneldredge@gmail.com>
     **/
    protected function probe($file)
    {
        $file = escapeshellarg($file);
        $cmd = "ffprobe -v quiet -print_format json -show_format -show_streams '{$file}'";
        exec($cmd, $outputLines);
        $json = implode("\n", $outputLines);

        return json_decode($json);
    }
}
