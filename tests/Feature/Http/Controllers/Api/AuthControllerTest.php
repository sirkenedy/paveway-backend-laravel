<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Role;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function testRegisterWithValidCredentials()
    {
        // $this->withoutExceptionHandling();

        Role::create([
            'title' => 'student'
        ]);
        $data = $this->data();
        $response = $this->json('POST', '/api/auth/signup', $data)->assertStatus(201)->assertJsonStructure([
            'token',
            'firstname',
            'lastname',
            'expires_in',
            'email',
            'token_type',
            'role',
        ]);;

        // $response->assertStatus(200);
    }

    public function testRegisterWithInvalidCredentials()
    {
        // Role::create([
        //     'title' => 'student'
        // ]);
        $data = $this->data();
        $response = $this->json('POST', '/api/auth/signup', $data)->assertStatus(422)->assertJsonStructure([
            'role',
        ]);;
    }

    /** @test */
    public function testLoginWithValidCredentials()
    {
        $data = [
            'email' => 'harnie@gmail.com',
            'password' => '123456',
        ];

        $this->testRegisterWithValidCredentials();
        $response = $this->json('POST', '/api/auth/signin', $data)->assertStatus(200)->assertJsonStructure([
            'token',
            'firstname',
            'lastname',
            'expires_in',
            'email',
            'token_type',
            'role',
        ]);;;
    }

    public function testLoginWithInvalidCredentials()
    {
        $data = [
            'email' => 'harni@gmail.com',
            'password' => '123456',
        ];

        $this->testRegisterWithValidCredentials();
        $response = $this->json('POST', '/api/auth/signin', $data)->assertStatus(404)->assertJsonStructure([
            'error',
        ]);
    }

    protected function data() {
        return [
            'email' => 'harnie@gmail.com',
            'password' => '123456',
            'firstname' => 'iyanu',
            'lastname' => 'anota',
            'unique_no' => "150707026",
            'confirm_password' => '123456',
            'role' => 'student',
        ];
    }
}
