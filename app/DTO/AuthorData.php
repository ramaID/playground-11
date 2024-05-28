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

    /**
     * Convert the DTO to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'biography' => $this->biography,
        ];
    }
}
