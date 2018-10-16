<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateThreads extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();
    }

    /** @test */
    function a_thread_requires_a_title_and_a_body_to_be_updated()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
        ])->assertSessionHasErrors('body');


    }

    /** @test */
    function unauthorized_users_may_not_update_thread()
    {
        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);

        $this->patch($thread->path(), [])->assertStatus(403);
    }

    /** @test */
    function a_thread_can_be_updated_by_its_creator()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body' => 'Changed body.'
        ]);

        $thread = $thread->fresh();

        $this->assertEquals('Changed', $thread->title);
        $this->assertEquals('Changed body.', $thread->body);
    }
}
