<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\AudioInspector;

use \Mockery as m;

class AudioInspectorTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetLength()
    {
        $file = 'example.flac';
        $inspector = new AudioInspector();

        $length = $inspector->getLength($file);
        $this->assertEquals('10', $length);
    }
}
