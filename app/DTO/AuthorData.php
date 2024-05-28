<?php

namespace App\DTO;

final class AuthorData
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?string $biography,
    ) {
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'biography' => $this->biography,
        ];
    }
}
