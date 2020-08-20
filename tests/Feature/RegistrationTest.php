<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $form_data = [
            'email' => time().'sample@gmail.com',
            'password' => 'password'
        ];

        $this->withoutExceptionHandling();

        $response = $this->post(route('auth.register'), $form_data);
        $response->assertStatus(201);
    }
}
