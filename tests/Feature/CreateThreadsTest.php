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
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads', []);
    }

    /**
     * Test to see if a guest is redirected to login when trying to see create thread screen.
     * @test
     */
    function guests_may_not_see_create_thread_page()
    {
        $this->withExceptionHandling()->get(route('Thread.Create'))
            ->assertRedirect('/login');
    }

}
