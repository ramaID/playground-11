<?php

namespace App\Services;

use App\DTO\AuthorData;
use App\Models\Author;
use Illuminate\Database\Eloquent\MassAssignmentException;

class AuthorService
{
    /**
     * @param AuthorData $data
     * @return array
     * @throws MassAssignmentException
     */
    public function createAuthor(AuthorData $data): array
    {
        $author = Author::query()->create([
            'name' => $data->name,
            'biography' => $data->biography,
        ]);

        return [
            'message' => 'Author created successfully',
            'data' => $author,
            'status' => 201,
        ];
    }
}
