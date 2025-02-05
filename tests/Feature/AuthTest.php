<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Laravel\Prompts\password;

uses(RefreshDatabase::class);

it('can register new user', function () {
    $response = $this->post(route('signup.store'), [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => bcrypt('password'),
    ]);

    $response->assertRedirect(route('index'));
    $this->assertDatabaseHas('users', [
        'email' => 'john@doe.com',
    ]);
});

it('can login', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password')
    ]);

    $response = $this->post(route('signin.authenticate'), [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $response->assertRedirect(route('index'));
    $this->assertAuthenticatedAs($user);
});

it('cannot login with incorrect credentials', function () {
   $user = User::factory()->create();
   $response = $this->post(route('signin.authenticate'), [
       'email' => 'john@doe.com',
       'password' => 'password',
   ]) ;
   $response->assertSessionHasErrors('email');
   $this->assertGuest();
});

it('cannot register with existing email', function () {
    $user = User::factory()->create();
    $response = $this->post(route('signup.store'), [
        'name' => 'John Doe',
        'email' => $user->email,
        'password' => 'password'
    ]);
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});