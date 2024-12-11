<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    public function __construct(
        protected AuthorService $service
    ) {}

    public function index()
    {
        $authors = $this->service->getAll();

        return response()->json($authors);
    }

    public function show($id)
    {
        $author = $this->service->getById($id);

        return response()->json($author);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = $this->service->create($request->toDto());

        return response()->json($author, 201);
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = $this->service->update($request->toDto());

        return response()->json($author);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(null, 204);
    }
}
