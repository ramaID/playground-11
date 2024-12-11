<?php

use App\Models\User;

it('has correct fillable attributes', function () {
    $user = new User;
    expect($user->getFillable())->toBe(['name', 'email', 'password']);
});

it('has correct hidden attributes', function () {
    $user = new User;
    expect($user->getHidden())->toBe(['password', 'remember_token']);
});

it('has correct cast attributes', function () {
    $user = new User;
    expect($user->getCasts())->toBe([
        'id' => 'int',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]);
});
