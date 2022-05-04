<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;


class CreateStatusTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_authenticated_user_can_create_statuses()
    {
        // 1. Given => teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // 2. When => Cuando hace un post request a status
        $this->post(route('status.store'), [ 'body' => 'Mi primer status' ]);

        // 3. Then => entonces veo un nuevo estado en la db
        $this->assertDatabaseHas('statuses', [
            'body' => 'Mi primer status'
        ]);
    }
}
