<?php

namespace App\DTOs;

class ProfileDTO
{
    public function __construct(
        public string $name,
        public string $firstname,
        public string $status,
        public ?string $image = null,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            firstname: $data['firstname'],
            image: $data['image'] ?? null,
            status: $data['status']
        );
    }
}
