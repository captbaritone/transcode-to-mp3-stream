<?php namespace Captbaritone\TranscodeToMp3Stream;

/**
 * Transcoded Size Estimator
 *
 * Estimate the byte size of an audio file given it's encoded bitrate and it's
 * lenght in seconds. This is NOT very accrurate. It does not account for
 * header size, and probably other variables that we are not able to easily
 * estimate. However, it seems to be close enough for our purposes.
 *
 * @author Jordan Eldredge <jordaneldredge@gmail.com>
 **/
class TranscodedSizeEstimator
{

    protected $bitsPerByte = 8;


    /**
     * Estimate Bytes
     *
     * Estimate the byte size of a constant rate mp3 given it's lenght and kbps
     *
     * @param float $length length of the audio in seconds
     * @param int $kbps constant bitrate kbit per second
     * @return int approximate size, in bytes, of the mp3
     * @author Jordan Eldredge <jordaneldredge@gmail.com>
     **/
    public function estimatedBytes($length, $kbps)
    {
        return round($this->estimatedBits($length, $kbps) / $this->bitsPerByte);
    }

    /**
     * Estimate Bits
     *
     * Estimate the bit size of a constant rate mp3 given it's lenght and kbps
     *
     * @param float $length length of the audio in seconds
     * @param int $kbps constant bitrate kbit per second
     * @return int approximate size, in bits, of the mp3
     * @author Jordan Eldredge <jordaneldredge@gmail.com>
     **/
    private function estimatedBits($length, $kbps)
    {
        return $length * $kbps * 1000;
    }
}
