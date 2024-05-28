<?php

use App\Models\Author;
use App\Services\AuthorService;

beforeEach(function () {
    Mockery::close();
    $this->mockAuthor = Mockery::mock('Eloquent', 'alias:\App\Models\Author')->makePartial()->shouldIgnoreMissing();
    $this->author = new Author(['name' => 'John Doe', 'biography' => 'An accomplished author.']);
});

afterEach(function () {
    Mockery::close();
});

test('get all authors', function () {
    $author2 = new Author(['name' => 'Jane Doe', 'biography' => 'A renowned author.']);
    $authors = collect([$this->author, $author2]);

    $this->mockAuthor->shouldReceive('all')->andReturn($authors);

    $authorService = new AuthorService();
    $result = $authorService->getAll();

    expect($result)->toBeInstanceOf(Illuminate\Support\Collection::class);
    expect($result)->toHaveCount(2);
});

it('can get author by id', function () {
    $this->mockAuthor->shouldReceive('findOrFail')->with(1)->andReturn($this->author);

    $authorService = new AuthorService();
    $result = $authorService->getById(1);

    expect($result)->toBeInstanceOf(Author::class);
});

it('can store new author', function () {
    $this->mockAuthor->shouldReceive('create')->andReturn($this->author);

    $authorService = new AuthorService();
    $result = $authorService->create(new \App\DTO\AuthorData(null, 'John Doe', 'An accomplished author.'));

    expect($result)->toBeInstanceOf(Author::class);
});

it('can update an author', function () {
    $dto = new \App\DTO\AuthorData(1, 'John Doe', 'An accomplished author.');

    $this->mockAuthor->shouldReceive('findOrFail')->with($dto->id)->andReturnSelf();
    $this->mockAuthor->shouldReceive('update')->once();

    $dto = new \App\DTO\AuthorData(1, 'John Doe', 'An accomplished author.');
    $authorService = new AuthorService();
    $result = $authorService->update($dto);

    expect($result)->toBeInstanceOf(Author::class);
});

it('can delete an author', function () {
    $id = 1;

    $this->mockAuthor->shouldReceive('findOrFail')->with($id)->andReturnSelf();
    $this->mockAuthor->shouldReceive('delete')->once();

    $authorService = new AuthorService();
    $authorService->delete($id);
});
