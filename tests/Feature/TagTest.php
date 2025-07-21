<?php

use App\Models\User;
use App\Models\Tag;

beforeEach(function () {
    // Create a user with admin role or proper permissions
    $this->actingAs(User::factory()->create([
        'role' => 'admin' // Assuming your User model has a role field
    ]));
});

it('can create a tag', function () {
    $this->post('/tags', ['name' => 'Test Tag'])
         ->assertRedirect('/tags');

    $this->assertDatabaseHas('tags', ['name' => 'Test Tag']);
});

it('requires authentication', function () {
    auth()->logout();
    
    $this->post('/tags', ['name' => 'Test Tag'])
         ->assertRedirect('/login');
});

it('requires authorization', function () {
    // Create a user without admin role
    $this->actingAs(User::factory()->create([
        'role' => 'user'
    ]));
    
    $this->post('/tags', ['name' => 'Test Tag'])
         ->assertStatus(403);
});