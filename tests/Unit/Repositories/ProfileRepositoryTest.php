<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Profile;
use App\Repositories\ProfileRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ProfileRepository $repository;

    protected function setUp(): void
    {
        // Appeler tous les seeders pour peupler la base de données
        parent::setUp();
        $this->repository = new ProfileRepository();
    }

    public function test_it_can_create_a_profile()
    {

        $data = [
            'name' => 'Mytest',
            'firstname' => 'Teddy',
            'status' => 'active',
            'image' => 'avatar.jpg',
        ];

        $profile = $this->repository->create($data);

        $this->assertDatabaseHas('profiles', ['name' => 'Mytest']);
        $this->assertInstanceOf(Profile::class, $profile);
    }

    public function test_it_can_fetch_all_profiles()
    {
        Profile::factory()->count(3)->create();

        $profiles = $this->repository->getAllProfiles();

        $this->assertCount(3, $profiles);
    }

    public function test_it_can_find_a_profile_by_id()
    {
        $profile = Profile::factory()->create();

        $found = $this->repository->findById($profile->id);

        $this->assertNotNull($found);
        $this->assertEquals($profile->id, $found->id);
    }

    public function test_it_can_update_a_profile()
    {
        $profile = Profile::factory()->create(['name' => 'Old Name']);

        $updated = $this->repository->update($profile, ['name' => 'New Name']);

        $this->assertTrue($updated);
        $this->assertEquals('New Name', $profile->fresh()->name);
    }

    public function test_it_can_delete_a_profile()
    {
        $profile = Profile::factory()->create();

        $deleted = $this->repository->delete($profile);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('profiles', ['id' => $profile->id]);
    }
}
