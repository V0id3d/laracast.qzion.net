<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Helper to allow for quick checking of validation errors.
     *
     * @param array $overrides
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Forum\Thread', $overrides);

        return $this->post(route('Thread.Store', $thread->toArray()));
    }

    /**
     * Test to see if authenticated user can create new forum threads.
     *
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Forum\Thread');
        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * Test to see if guest can create thread.
     *
     * @test
     */
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get(route('Thread.Create'))
            ->assertRedirect('/login');

        $this->post(route('Thread.Store'), [])
            ->assertRedirect('/login');
    }

    /**
     * Test that the thread title section has been filled out.
     *
     * @test
     */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * Test that the thread body section has been filled out.
     *
     * @test
     */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * Test that the thread valid channel section has been filled out.
     *
     * @test
     */
    public function a_thread_requires_a_valid_channel()
    {
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 8780])
            ->assertSessionHasErrors('channel_id');
    }
}
