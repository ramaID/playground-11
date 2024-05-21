<?php

namespace App\DTO;

final class AuthorData
{
    public function __construct(
        public string $name,
        public ?string $biography,
    ) {
    }
}
