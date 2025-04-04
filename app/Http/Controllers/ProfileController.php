<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use App\DTOs\ProfileDTO;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Liste tous les profils actifs.
     */
    public function index(Request $request): JsonResponse
    {
        $profiles = $this->profileService->getActiveProfiles($request->bearerToken());

        return response()->json($profiles);
    }

    /**
     * Crée un nouveau profil.
     */
    public function store(ProfileRequest $request): JsonResponse
    {
        $profileDTO = ProfileDTO::fromRequest($request->validated());
        $profile = $this->profileService->store($profileDTO);

        return response()->json($profile, 201);
    }

    /**
     * Affiche un profil spécifique.
     */
    public function show(Profile $profile): JsonResponse
    {
        return response()->json($profile);
    }

    /**
     * Met à jour un profil existant.
     */
    public function update(ProfileRequest $request, Profile $profile): JsonResponse
    {
        $profileDTO = ProfileDTO::fromRequest($request->validated());
        $updatedProfile = $this->profileService->update($profileDTO, $profile->id);

        if (!$updatedProfile) {
            return response()->json(['message' => 'Failed to update profile'], 400);
        }

        return response()->json($profile);
    }

    /**
     * Supprime un profil.
     */
    public function destroy(Profile $profile): JsonResponse
    {
        $deleted = $this->profileService->delete($profile->id);

        if (!$deleted) {
            return response()->json(['message' => 'Failed to delete profile'], 500);
        }

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
