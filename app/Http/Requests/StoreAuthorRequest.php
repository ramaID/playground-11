<?php

namespace App\Http\Requests;

use App\DTO\AuthorData;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:authors,name',
            'biography' => 'nullable|string',
        ];
    }

    public function toDto(): AuthorData
    {
        return new AuthorData(
            name: $this->input('name', ''),
            biography: $this->input('biography', null),
        );
    }
}