<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    public function __construct(
        protected AuthorService $service
    ) {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->service->createAuthor($request->toDto());

        return response()->json($result, 201);
    }
}
