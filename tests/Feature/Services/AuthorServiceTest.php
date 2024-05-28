<?php

use App\DTO\AuthorData;
use App\Services\AuthorService;

beforeEach(function () {
    $this->service = Mockery::mock(AuthorService::class);
});

it('gets all authors', function () {
    $this->service->shouldReceive('getAll')->andReturn(collect(['author1', 'author2']));

    $authors = $this->service->getAll();

    expect($authors->toArray())->toEqual(['author1', 'author2']);
});

it('shows a single author', function () {
    $this->service->shouldReceive('getById')->with(1)->andReturn([
        'id' => 'ulid',
        'name' => 'author1',
    ]);

    $author = $this->service->getById(1);

    expect($author)->toEqual([
        'id' => 'ulid',
        'name' => 'author1',
    ]);
});

it('stores a new author', function () {
    $this->service->shouldReceive('create')->andReturn([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);

    $dto = new AuthorData(null, 'New Author', null);
    $author = $this->service->create($dto);

    expect($author)->toEqual([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);
});

it('update existing author', function () {
    $this->service->shouldReceive('update')->andReturn([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);

    $dto = new AuthorData('ulid', 'New Author', null);
    $author = $this->service->update($dto);

    expect($author)->toEqual([
        'id' => 'ulid',
        'name' => 'New Author',
    ]);
});

it('delete existing author', function () {
    $this->service->shouldReceive('delete');

    $this->service->delete('ulid');

    expect(true)->toBeTrue();
});

it('convert dto toArray', function () {
    $dto = new AuthorData('ulid', 'New Author', 'Biography');

    expect($dto->toArray())->toEqual([
        'name' => 'New Author',
        'biography' => 'Biography',
    ]);
});

afterEach(function () {
    Mockery::close();
});
