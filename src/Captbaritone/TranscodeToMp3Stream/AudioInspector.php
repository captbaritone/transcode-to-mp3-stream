<?php namespace Captbaritone\TranscodeToMp3Stream;

class AudioInspector
{

    public function getLength($file)
    {
        $json = $this->probe($file);
        return $json->streams[0]->duration;
    }

    protected function probe($file)
    {
        $cmd = "ffprobe -v quiet -print_format json -show_format -show_streams '{$file}'";
        exec($cmd, $outputLines);
        $json = implode("\n", $outputLines);

        return json_decode($json);
    }
}
