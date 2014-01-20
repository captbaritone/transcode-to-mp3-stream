<?php namespace Captbaritone\TranscodeToMp3Stream;

class HeaderBuilder
{

    public function putHeader($filename, $size)
    {
        //$time = date('r', filemtime($this->source));
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Accept-Ranges: bytes');
        header("Content-Length: {$size}");
        header('Content-type: audio/mpeg');
        header("Content-Disposition: inline; filename=\"{$filename}\"");
        header("Content-Transfer-Encoding: binary");
        //header("Last-Modified: $time");
    }
}
