# Transcode to MP3 Stream PHP Library

[![Build Status](https://travis-ci.org/captbaritone/transcode-to-mp3-stream.png?branch=master)](https://travis-ci.org/captbaritone/transcode-to-mp3-stream)

Transcode, on the fly, any media file that ffmpeg can read into an MP3 stream
playable natively by any modern browser. The library handles the annoying
requirements of generating the correct headers and relies on ffmpeg to handle
the actual transcoding.

Useful for cases where you have a large collection of audio files which you
want users to be able to stream, but don't wish to transcode them all in
advance.

Works well with HTML5/JS audio players such as
[audio.js](http://kolber.github.io/audiojs/).

## Status

Beta. This package is working, but may still have some kinks to workout.

## Dependencies

We require shell access to `ffmpeg` with the `lame` codec for mp3 encoding.
We also require a newish version of `ffprobe` (which comes with `ffmpeg`).
However, the current version of in the Ubuntu repository is not modern enough.
I'll update with more on that later.

On Ubuntu, these packages do the trick for me:

    sudo apt-get install ffmpeg
    sudo apt-get install libavcodec-extra-53

## Installation

Add this line to your `composer.json` file's "require" section:

    "captbaritone/transcode-to-mp3-stream": "dev-master"

Then issue at the command line, in your projects directory:

    composer update

## Usage

I'm assuming, you have the package installed via composer.

The only method you should need is `output()` on the `Mp3Stream` object. It
takes the following arguments, of which only the first is required:

- `$sourceMedia` Path to the file  you wish to transcode
- `$outputFilename` The filename for the transcoded output
- `$kbps` The constant bitrate bits per second to encode the output with
- `$start` The point in the source where we want to start (in seconds)
- `$end` The point in the source where we want to stop (in seconds)

### Simple usage:

    <?php

    use Captbaritone\TranscodeToMp3Stream\Mp3Stream;

    $mp3Stream = new Mp3Stream();
    $mp3Stream->output('example.flac');

## Example

See `example.php` for an example of how the script can be used.

If you have a new enough version of PHP, you could test it by issuing this in
your terminal...

    cd /path/to/transcode-to-mp3-stream
    php -S localhost:9000 example.php


...and then opening `http://localhost:8000` in your browser.

## Testing

Assuming you have both composer and phpunit install globally:

    git clone git@github.com:captbaritone/transcode-to-mp3-stream.git
    cd transcode-to-mp3-stream
    composer --dev install
    phpunit

## Help/questions

If you have any questions, or get stuck please let me know:
<jordan@jordaneldredge.com>.

## License

This project is released under the MIT License. The example audio file is an
excerpt from a Creative Commons recording of J.S. Bach's Goldberg Variations.
You can find the whole recording, and more information at the [Open Goldberg
Variations] website.

[Open Goldberg Variations]: http://www.opengoldbergvariations.org/

