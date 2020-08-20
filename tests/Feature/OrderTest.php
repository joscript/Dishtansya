<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use
    public function testOrder()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $form_data = [
            'product_id' => 1,
            'quantity' => 5
        ];

        $this->withoutExceptionHandling();

        $response = $this->json('POST', route('order.make_order'), $form_data);
        $response->assertStatus(201);
    }
}
