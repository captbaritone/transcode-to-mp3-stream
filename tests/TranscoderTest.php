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

        $command = $transcoder->command('testfile.flac', 'KBPS', 'start', 'end');

        $expected = "avconv -ss 'start' -t 'end' -i 'testfile.flac' -ab 'KBPSk' -minrate 'KBPSk' -maxrate 'KBPSk' -bufsize 64k -f mp3 -map_metadata -1  - 2>/dev/null";

        $this->assertEquals($command, $expected);
    }

}
