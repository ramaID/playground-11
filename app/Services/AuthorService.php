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
        return Author::findOrFail($id);
    }

    public function create(AuthorData $data)
    {
        return Author::create($data->toArray());
    }

    public function update(AuthorData $data)
    {
        $author = Author::findOrFail($data->id);
        $author->update($data->toArray());
        return $author;
    }

    public function delete($id): void
    {
        $author = Author::findOrFail($id);
        $author->delete();
    }
}
