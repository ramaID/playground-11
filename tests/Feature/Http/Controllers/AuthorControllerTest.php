<?php

use App\Services\AuthorService;
use Illuminate\Support\Facades\App;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;

beforeEach(function () {
    $this->service = Mockery::mock(AuthorService::class);
    App::instance(AuthorService::class, $this->service);
});

it('gets all authors', function () {
    $this->service->shouldReceive('getAll')->andReturn(collect(['author1', 'author2']));

    $response = get('/api/authors');

    $response->assertStatus(200);
    $response->assertJson(['author1', 'author2']);
});

it('shows a single author', function () {
    $this->service->shouldReceive('getById')->with(1)->andReturn([
        'id' => 'ulid',
        'name' => 'author1',
    ]);

    $response = get('/api/authors/1');
    $response->assertStatus(200);
    $response->assertJson([
        'id' => 'ulid',
        'name' => 'author1',
    ]);
});

it('stores a new author', function () {
    $this->service->shouldReceive('create')->andReturn([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);

    $response = post('/api/authors', ['name' => 'New Author']);

    $response->assertStatus(201);
    $response->assertJson([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);
});

it('updates an author', function () {
    $this->service->shouldReceive('update')->andReturn([
        'id' => 'ulid',
        'name' => 'authorUpdated',
    ]);

    $response = put('/api/authors/1', ['name' => 'Updated Author']);

    $response->assertStatus(200);
    $response->assertJson([
        'id' => 'ulid',
        'name' => 'authorUpdated',
    ]);
});

it('deletes an author', function () {
    $this->service->shouldReceive('delete')->andReturn(null);

    $response = delete('/api/authors/1');

    $response->assertStatus(204);
});
