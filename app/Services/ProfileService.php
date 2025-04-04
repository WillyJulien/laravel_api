<?php

namespace App\Services;

use App\DTOs\ProfileDTO;
use App\Repositories\ProfileRepository;
use App\Models\Profile;

class ProfileService
{
    protected ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Créer un profil avec les données DTO
     *
     * @param ProfileDTO $profileDTO
     * @return Profile
     */
    public function store(ProfileDTO $profileDTO): Profile
    {
        $profileData = [
            'name' => $profileDTO->name,
            'firstname' => $profileDTO->firstname,
            'status' => $profileDTO->status,
            'image' => $profileDTO->image,
        ];

        return $this->profileRepository->create($profileData);
    }

    /**
     * Mettre à jour un profil avec les données DTO
     *
     * @param ProfileDTO $profileDTO
     * @param int $id
     * @return bool
     */
    public function update(ProfileDTO $profileDTO, int $id): bool
    {
        $profile = $this->profileRepository->findById($id);

        if (!$profile) {
            return false;  // Si le profil n'existe pas
        }

        $profileData = [
            'name' => $profileDTO->name,
            'firstname' => $profileDTO->firstname,
            'status' => $profileDTO->status,
            'image' => $profileDTO->image,
        ];

        return $this->profileRepository->update($profile, $profileData);
    }

    /**
     * Supprimer un profil
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $profile = $this->profileRepository->findById($id);

        if (!$profile) {
            return false;  // Si le profil n'existe pas
        }

        return $this->profileRepository->delete($profile);
    }

    /**
     * Récupérer tous les profils actifs
     *
     * @return Collection
     */
    public function getActiveProfiles()
    {
        return $this->profileRepository->getActiveProfiles();
    }

    /**
     * Récupérer un profil par son ID
     *
     * @param int $id
     * @return Profile|null
     */
    public function getProfileById(int $id): ?Profile
    {
        return $this->profileRepository->findById($id);
    }
}
