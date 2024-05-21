<?php

// tests/Feature/Services/AuthorServiceTest.php

use App\DTO\AuthorData;
use App\Services\AuthorService;

it('create an author from service', function () {
    $service = new AuthorService();
    $authorData = new AuthorData('Test Author', 'Test Biography');

    $author = $service->createAuthor($authorData);

    expect($author)->toBeArray()
        ->and($author)->toHaveKey('message')
        ->and($author)->toHaveKey('data')
        ->and($author)->toHaveKey('status')
        ->and($author['data'])
            ->toHaveKeys([
                'name',
                'biography',
                'id',
                'updated_at',
                'created_at',
            ]);
});
