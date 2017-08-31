<?php namespace Captbaritone\TranscodeToMp3Stream;

class Pipe
{

    private $handle;
    private $pipes;

    public function open($cmd)
    {
        $this->handle = proc_open($cmd, [ 1 => [ 'pipe', 'w' ] ], $this->pipes);
        register_shutdown_function( [ $this, 'terminate' ] );
    }

    public function fread($bytes)
    {
        return fread($this->pipes[1], $bytes);
    }

    public function feof()
    {
        return feof($this->pipes[1]);
    }

    public function close()
    {
        fclose($this->pipes[1]);
        return pclose($this->handle);
    }

    public function terminate()
    {
        return proc_terminate($this->handle);
    }

}
