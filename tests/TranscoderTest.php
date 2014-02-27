<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\Transcoder;

use \Mockery as m;

class TranscoderTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testTranscoderCommand()
    {
        $transcoder = new Transcoder();

        $command = $transcoder->command('testfile.flac', 'KBPS', 'start', 'duration');

        $expected = "ffmpeg -ss 'start' -t 'duration' -i 'testfile.flac' -ab 'KBPSk' -minrate 'KBPSk' -maxrate 'KBPSk' -bufsize 64k -f mp3 -map_metadata -1  - 2>/dev/null";

        $this->assertEquals($command, $expected);
    }


    public function testFFmpegCommandWorks()
    {
        $start = 2;
        $duration = 5;
        $kbps = 192;
        $testFilename = 'phpunit_test.mp3';

        $transcoder = new Transcoder();

        $command = $transcoder->command('example.flac', $kbps, $start, $duration);
        $command .= " > {$testFilename}";
        shell_exec($command);

        $data = json_decode(shell_exec("ffprobe -v quiet -print_format json -show_format -show_streams {$testFilename}"));

        $this->assertEquals($duration, round($data->format->duration, 1));
        $this->assertEquals('mp3', $data->format->format_name);
        $this->assertEquals($kbps * 1000, $data->streams[0]->bit_rate);
        unlink($testFilename);
    }

}
