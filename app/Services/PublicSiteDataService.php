<?php

namespace App\Services;

use App\DTOs\PublicSiteDataDTO;

class PublicSiteDataService
{
    protected $data;

    // Utilisation d'un constructeur pour initialiser les données
    public function __construct()
    {
        // Récupérer les données depuis les variables d'environnement
        $this->data = [
            'chiffre_affaire' => (int) env('PUBLIC_SITE_CHIFFRE_AFFAIRE', 0),
            'nombre_utilisateurs' => (int) env('PUBLIC_SITE_NOMBRE_UTILISATEURS', 0),
            'nombre_projets' => (int) env('PUBLIC_SITE_NOMBRE_PROJETS', 0),
        ];
    }

    /**
     * Retourne toutes les données encapsulées dans un DTO.
     */
    public function index(): PublicSiteDataDTO
    {
        // Retourner les données encapsulées dans un DTO
        return new PublicSiteDataDTO($this->data);
    }
}
