<?php

namespace App\Services;

use App\DTOs\PublicSiteDataDTO;

class PublicSiteDataService
{
    protected $public_datas;

    // Utilisation d'un constructeur pour initialiser les données
    public function __construct()
    {
        // Récupérer les données depuis les variables d'environnement
        $this->public_datas = [
            'chiffre-affaire' => public_data('chiffre-affaire'),
            'nombre-utilisateurs' => public_data('nombre-utilisateurs'),
            'nombre-projets' => public_data('nombre-projets'),
        ];
    }

    /**
     * Retourne toutes les données encapsulées dans un DTO.
     */
    public function index(): PublicSiteDataDTO
    {
        // Retourner les données encapsulées dans un DTO
        return new PublicSiteDataDTO($this->public_datas);
    }

}
