<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Forum\Thread')->create();
    }

    /**
     * Test to see if a thread can hold replies
     * @test
     */
    public function a_thread_has_replies()
    {
//        $thread = factory('App\Forum\Thread')->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /**
     * Test to see if thread has a creator
     * @test
     */
    public function a_thread_has_a_creator()
    {
//        $thread = factory('App\Forum\Thread')->create();
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }

    /**
     * Test to see if a thread can add a reply
     * @test
     */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

}
