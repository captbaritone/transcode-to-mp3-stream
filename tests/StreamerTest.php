<?php namespace Captbaritone\TranscodeToMp3Stream\Tests;

use Captbaritone\TranscodeToMp3Stream\Streamer;

use \Mockery as m;

class StreamerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testOutputStreamTooShort()
    {
        $pipe = m::mock('Pipe');

        $pipe->shouldReceive('open')
            ->once();

        $pipe->shouldReceive('feof')
            ->once()
            ->andReturn(false);

        $pipe->shouldReceive('feof')
            ->once()
            ->andReturn(true);

        $pipe->shouldReceive('fread')
            ->with(1)
            ->once()
            ->andReturn("a");

        $pipe->shouldReceive('close')->once();

        $streamer = new Streamer($pipe);

        $streamer->outputStream($pipe, 3);
        $this->expectOutputString('a00');
    }

    public function testOutputStreamTooLong()
    {
        $pipe = m::mock('Pipe');

        $pipe->shouldReceive('open')
            ->once();

        $pipe->shouldReceive('feof')
            ->once()
            ->andReturn(false);

        $pipe->shouldReceive('fread')
            ->with(1)
            ->andReturn("a");

        $pipe->shouldReceive('close')->once();

        $streamer = new Streamer($pipe);

        $streamer->outputStream($pipe, 1);
        $this->expectOutputString('a');
    }

}
