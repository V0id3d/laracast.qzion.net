<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test to see if an authenticated user can post on the threads
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();
        $thread = create('App\Forum\Thread');
        $reply = make('App\Forum\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /**
     * A User that is not authenticated can not participate in forum threads.
     * @test
     */
    public function a_non_authenticated_user_may_not_participate_in_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = create('App\Forum\Thread');
        $reply = make('App\Forum\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());
    }

    /**
     * Tests to ensure that the reply has a body
     * @test
     */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Forum\Thread');
        $reply = make('App\Forum\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    }
}
