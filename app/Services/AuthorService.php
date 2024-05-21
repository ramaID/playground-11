<?php

namespace App\Services;

use App\DTO\AuthorData;
use App\Models\Author;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class AuthorService
{
    /**
     * @param AuthorData $data
     * @return array<string, Author|int|string>
     * @throws InvalidArgumentException
     * @throws InvalidCastException
     */
    public function createAuthor(AuthorData $data): array
    {
        $author = new Author();
        $author->name = $data->name;
        $author->biography = $data->biography;
        $author->save();

        return [
            'message' => 'Author created successfully',
            'data' => $author,
            'status' => 201,
        ];
    }
}
