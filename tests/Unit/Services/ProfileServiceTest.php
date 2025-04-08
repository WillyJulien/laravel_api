<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ProfileService;
use App\DTOs\ProfileDTO;
use App\Repositories\ProfileRepository;

class ProfileServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_store_calls_repository_create()
    {
        $repo = $this->createMock(ProfileRepository::class);
        $repo->expects($this->once())
             ->method('create')
             ->with($this->arrayHasKey('name'));

        $service = new ProfileService($repo);

        $dto = ProfileDTO::fromRequest([
            'name' => 'Julien',
            'firstname' => 'Teddy',
            'status' => 'active',
            'image' => 'avatar.jpg'
        ]);

        $service->store($dto);
    }

}
