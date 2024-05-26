<?php

namespace App\Http\Requests;

use App\DTO\AuthorData;

class UpdateAuthorRequest extends StoreAuthorRequest
{
    /**
     * @return AuthorData
     */
    public function toDto(): AuthorData
    {
        return new AuthorData(
            $this->route('author'),
            $this->input('name', ''),
            $this->input('biography', null)
        );
    }
}
