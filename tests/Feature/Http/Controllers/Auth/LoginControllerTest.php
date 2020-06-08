<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function testAuthenticatesAndRedirectsUserTest()
      {
          $user = factory(User::class)->create();

          // ...
      }

      public function testDisplayLoginTest()
      {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
      }

    public function testLoginDisplaysValidationErrors()
    {
      $response = $this->post('/login', []);

      $response->assertStatus(302);
      $response->assertSessionHasErrors('email');
  }
}
