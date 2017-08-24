<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Forum\Thread')->create();
    }

    /**
     * Test to see if a user can browse the actual created threads
     */
    public function test_user_can_browse_threads()
    {
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }


    /**
     * Test to see if a user can see a specific thread
     */
    public function test_user_can_view_specific_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    public function test_user_can_read_replies_thaat_are_associated_with_thread()
    {
        // Given we have a thread
        // Thread includes replies
        // Visit thread page should see replies
    }
}
