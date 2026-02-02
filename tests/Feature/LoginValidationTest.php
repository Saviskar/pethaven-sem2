<?php

use App\Models\User;

test('email is required for login', function () {
    $response = $this->post('/login', [
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
});

test('password is required for login', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
    ]);

    $response->assertSessionHasErrors('password');
});

test('email must be a valid email address', function () {
    $response = $this->post('/login', [
        'email' => 'not-an-email',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});
