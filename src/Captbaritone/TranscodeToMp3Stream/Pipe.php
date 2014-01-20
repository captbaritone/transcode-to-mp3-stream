<?php namespace Captbaritone\TranscodeToMp3Stream;

class Pipe
{

    private $handle;

    public function open($cmd, $mode)
    {
        $this->handle = popen($cmd, $mode);
    }

    public function fread($bytes)
    {
        return fread($this->handle, $bytes);
    }

    public function feof()
    {
        return feof($this->handle);
    }

    public function close()
    {
        return pclose($this->handle);
    }
}
