<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Checks to see if a reply has an owner.
     *
     * @test
     */
    public function it_has_an_owner()
    {
        $reply = create('App\Forum\Reply');
        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
