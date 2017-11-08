<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Forum\Thread');
    }

    /**
     * Test to see if the path method is showing properly.
     *
     * @test
     */
    public function a_thread_can_make_a_string_path()
    {
        $this->assertEquals("/threads/{$this->thread->channel->slug}/{$this->thread->id}", $this->thread->path());
    }

    /**
     * Test to see if a thread can hold replies.
     *
     * @test
     */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /**
     * Test to see if thread has a creator.
     *
     * @test
     */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }

    /**
     * Test to see if a thread can add a reply.
     *
     * @test
     */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body'    => 'Simple Test',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /**
     * Test to see if a thread belongs to a channel.
     *
     * @test
     */
    public function a_thread_belongs_to_a_channel()
    {
        $this->assertInstanceOf('App\Forum\Channel', $this->thread->channel);
    }
}
