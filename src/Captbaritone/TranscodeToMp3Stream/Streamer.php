<?php namespace Captbaritone\TranscodeToMp3Stream;

use Captbaritone\TranscodeToMp3Stream\Pipe;

class Streamer
{

    protected $pipe;

    public function __construct($pipe = false)
    {
        $this->pipe = $pipe ?: new Pipe();
    }

    public function outputStream($cmd, $byteGoal)
    {
        $this->pipe->open($cmd, 'r');

        // Initilize our count of bytes sent
        $outputSize = 0;

        while (!$this->pipe->feof()) {

            $content = $this->pipe->fread(1);

            echo $content;

            $outputSize += strlen($content);

            // check to make sure we have't reached our goal
            if($outputSize >= $byteGoal)
            {
                break;
            }
        }

        echo $this->getPadding($outputSize, $byteGoal);

        $this->pipe->close();
    }

    protected function getPadding($outputSize, $byteGoal)
    {
        // If we still haven't reached our goal, fill the remaining bytes with
        // "0"
        if($outputSize <= $byteGoal){
            return str_pad('', $byteGoal - $outputSize, '0');
        }

        return '';
    }
}
