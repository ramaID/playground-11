<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function __construct(
        protected AuthorService $service
    ) {
    }

    public function index(): JsonResponse
    {
        $authors = $this->service->getAll();
        return response()->json($authors);
    }

    public function show(Author $author): JsonResponse
    {
        $author = $this->service->getById($author->getKey());
        return response()->json($author);
    }

    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = $this->service->create($request->toDto());
        return response()->json($author, 201);
    }

    public function update(UpdateAuthorRequest $request, string $id): JsonResponse
    {
        $author = $this->service->update($request->toDto());
        return response()->json($author);
    }

    public function destroy($id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
