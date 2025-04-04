<?php

namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository
{
    /**
     * Récupérer tous les profils actifs
     *
     * @return Collection
     */
    public function getActiveProfiles(): Collection
    {
        return Profile::where('status', 'active')->get();
    }

    /**
     * Créer un nouveau profil
     *
     * @param array $data
     * @return Profile
     */
    public function create(array $data): Profile
    {
        return Profile::create($data);
    }

    /**
     * Mettre à jour un profil existant
     *
     * @param Profile $profile
     * @param array $data
     * @return bool
     */
    public function update(Profile $profile, array $data): bool
    {
        return $profile->update($data);
    }

    /**
     * Supprimer un profil
     *
     * @param Profile $profile
     * @return bool
     */
    public function delete(Profile $profile): bool
    {
        return $profile->delete();
    }

    /**
     * Récupérer un profil spécifique par son ID
     *
     * @param int $id
     * @return Profile|null
     */
    public function findById(int $id): ?Profile
    {
        return Profile::find($id);
    }
}
