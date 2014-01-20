<?php namespace Captbaritone\TranscodeToMp3Stream;

class TranscodedSizeEstimator
{

    protected $bitsPerByte = 8;

    public function estimatedBytes($length, $kbps)
    {
        return round($this->estimatedBits($length, $kbps) / $this->bitsPerByte);
    }

    private function estimatedBits($length, $kbps)
    {
        return $length * $kbps * 1000;
    }
}
