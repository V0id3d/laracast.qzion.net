<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Test to see if authenticated user can create new forum threads
     * @test
     */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Forum\Thread');
        $this->post('/threads', $thread->toArray());
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * Test to see if guest can create thread
     * @test
     */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get(route('Thread.Create'))
            ->assertRedirect('/login');

        $this->post(route('Thread.Store'), [])
            ->assertRedirect('/login');
    }


}
