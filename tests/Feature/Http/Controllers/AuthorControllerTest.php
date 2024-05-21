<?php

// tests/Feature/Http/Controllers/AuthorControllerTest.php

use App\Models\Author;
use function Pest\Laravel\postJson;

test('create an author from request', function () {
    $attributes = [
        'name' => 'Test Author',
        'biography' => 'Test Biography',
    ];
    $request = postJson('/api/authors', $attributes);
    $author = Author::query()->where($attributes)->first();
    $updatedAt = $author->updated_at->format('Y-m-d\TH:i:s.u\Z');
    $createdAt = $author->updated_at->format('Y-m-d\TH:i:s.u\Z');

    $request->assertStatus(201)
        ->assertJson([
            'message' => 'Author created successfully',
            'data' => [
                'name' => 'Test Author',
                'biography' => 'Test Biography',
                'id' => $author->id,
                'updated_at' => $updatedAt,
                'created_at' => $createdAt,
            ],
            'status' => 201,
        ]);
});
