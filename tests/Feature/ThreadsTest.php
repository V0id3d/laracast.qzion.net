<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
//    use DatabaseMigrations;

    /**
     * Test to see if a user can browse the actual created threads
     */
    public function test_user_can_browse_threads()
    {
        $thread = factory('App\Forum\Thread')->create();
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }


    /**
     * Test to see if a user can see a specific thread
     */
    public function test_user_can_view_specific_thread()
    {
        $thread = factory('App\Forum\Thread')->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }

}
