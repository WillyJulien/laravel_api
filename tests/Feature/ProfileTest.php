<?php

namespace Tests\Feature;

use App\Models\Administrator;
use App\Models\Profile;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
    * A basic feature test example.
    */

    private function authenticate(): string
    {
        // Retrieve the first administrator from the database.
        $admin = Administrator::first();

        // Perform a POST request to '/api/admin/login' with the administrator's credentials.
        $response = $this->post('/api/admin/login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        // Assert that the response status is 200 (OK).
        $response->assertStatus(200);

        // Return the authentication token from the response JSON.
        return $response->json('token');
    }


    public function test_index_profile_success_unauthenticated(): void
    {

        // Sending a GET request to 'api/profile'.
        $response = $this->get('api/profile');
        // Asserting that the response status is 200 ( OK ).
        $response->assertStatus(200);
        // Asserting the JSON structure of the response without status field.
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'firstname',
                'image',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_index_profile_success_authenticated(): void
    {

        $token = $this->authenticate();

        // Sending a GET request to 'api/profile' with the token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/profile');
        // Asserting that the response status is 200 ( OK ).
        $response->assertStatus(200);
        // Asserting the JSON structure of the response with status fields.
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'firstname',
                'image',
                'status',
                'created_at',
                'updated_at'
            ]
        ]);

        // logout administrator
        $this->post('api/admin/logout');
    }

    public function test_show_profile_success(): void
    {

        $token = $this->authenticate();

        $profile = Profile::factory()->create();

        // Sending a GET request to 'api/profile' with the token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("api/profile/{$profile->id}");
        // Asserting that the response status is 200 ( OK ).
        $response->assertStatus(200);
        // Asserting the JSON structure of the response.
        $response->assertJsonStructure([
            'id',
            'name',
            'firstname',
            'status',
            'image',
            'created_at',
            'updated_at'
        ]);
        $profile->delete();

        // logout administrator
        $this->post('api/admin/logout');
    }

    public function test_show_profile_failed(): void
    {

        $token = $this->authenticate();

        $profile = Profile::factory()->create();
        // last profileId + one.
        $profileId = $profile->id  + 1;

        // Sending a GET request to 'api/profile' with the token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("api/profile/{$profileId}");
        // Asserting that the response status is 200 ( NOT FOUND ).
        $response->assertStatus(404);

        $profile->delete();
        // logout administrator
        $this->post('api/admin/logout');
    }

    public function test_store_profile_success()
    {

        $token = $this->authenticate();

        // Data for creating a new profile.
        $profileData = [
            'name' => 'julien',
            'firstname' => 'Teddy',
            'status' => 'pending',
            'image' => 'test'
        ];

        // Sending a GET request to 'api/profile' with the token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('api/profile', $profileData);

        // Asserting that the response status is 201 ( CREATED ).
        $response->assertStatus(201);
        // Finding and deleting the created profile to clean up.
        $lastProfile = Profile::latest('created_at')->first();
        $lastProfile->delete();
        // logout administrator
        $this->post('api/admin/logout');
    }

    public function test_store_profile_failed()
    {

        $token = $this->authenticate();

        // Data for creating a new profile with error (firstname).
        $profileData = [
            'name' => 'julien',
            'firstname' => 2,
            'status' => 'pending',
            'image' => 'test'
        ];

        // Sending a post request to 'api/profile' with the token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('api/profile', $profileData);

        // Asserting that the response status is 422 ( UNPROCESSABLE ENTITY ).
        $response->assertStatus(422);
        // logout administrator
        $this->post('api/admin/logout');
    }
}
