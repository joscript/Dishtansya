<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // $form_data = [
        //     'email' => 'josua.lagat@gmail.com',
        //     'password' => 'password'
        // ];

        // $this->withoutExceptionHandling();

        // $response = $this->post(route('auth.login'), $form_data);
        // $response->assertStatus(201);
    }
}
