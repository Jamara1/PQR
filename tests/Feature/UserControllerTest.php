<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test user post.
     *
     * @test
     */
    public function a_user_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/usuarios', [
            'name' => 'Test name',
            'email' => 'test@gmail.com',
            'password' => '123456',
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, User::all());

        $user = User::first();

        $this->assertEquals($user->name, 'Test name');
        $this->assertEquals($user->email, 'test@gmail.com');
        $this->assertEquals($user->password, '123456');
    }
}
