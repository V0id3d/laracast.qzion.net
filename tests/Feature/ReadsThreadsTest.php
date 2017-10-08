<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Forum\Thread');
    }

    /**
     * Test to see if a user can browse the actual created threads
     * @test
     */
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }


    /**
     * Test to see if a user can see a specific thread
     * @test
     */
    public function a_user_can_view_specific_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /**
     * Test to see if a user can read replies from a thread
     * @test
     */
    public function a_user_can_read_replies_that_are_associated_with_thread()
    {
        $reply = create('App\Forum\Reply', ['thread_id' => $this->thread->id]);
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($reply->body);

    }
}
