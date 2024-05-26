<?php

namespace App\Services;

use App\DTO\AuthorData;
use App\Models\Author;

class AuthorService
{
    public function getAll()
    {
        return Author::all();
    }

    public function getById($id)
    {
        return Author::query()->findOrFail($id);
    }

    public function create(AuthorData $data)
    {
        return Author::query()->create($data->toArray());
    }

    public function update(AuthorData $data)
    {
        $author = Author::query()->findOrFail($data->id);
        $author->update($data->toArray());
        return $author;
    }

    public function delete($id): void
    {
        $author = Author::query()->findOrFail($id);
        $author->delete();
    }
}
