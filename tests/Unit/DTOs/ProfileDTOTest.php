<?php

namespace Tests\Unit\DTOs;

use App\DTOs\ProfileDTO;
use PHPUnit\Framework\TestCase;

class ProfileDTOTest extends TestCase
{
    /**
     * test dto profile.
     */
    public function test_profile_dto_has_expected_properties()
    {
        $dto = ProfileDTO::fromRequest([
            'name' => 'Julien',
            'firstname' => 'Teddy',
            'status' => 'active',
            'image' => 'avatar.jpg'
        ]);

        $this->assertEquals('Julien', $dto->name);
        $this->assertEquals('Teddy', $dto->firstname);
    }

}
