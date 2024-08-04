<?php

use App\Models\User;

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create());

    $this->put('/user/profile-information', [
        'username' => 'testname',
        'email' => 'test@example.com',
    ]);

    expect($user->fresh())
        ->username->toEqual('testname')
        ->email->toEqual('test@example.com');
});
