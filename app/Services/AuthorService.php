<?php

namespace App\Services;

use App\DTO\AuthorData;
use App\Models\Author;

class AuthorService
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Author::all();
    }

    public function getById(string $id): Author
    {
        return Author::findOrFail($id);
    }

    public function create(AuthorData $data): Author
    {
        return Author::query()->create($data->toArray());
    }

    public function update(AuthorData $data): Author
    {
        $author = Author::findOrFail($data->id);
        $author->update($data->toArray());
        return $author->refresh();
    }

    public function delete(string $id): void
    {
        $author = Author::findOrFail($id);
        $author->delete();
    }
}
