<?php

namespace App\DTOs;

class PublicSiteDataDTO
 {
    public $chiffreAffaire;
    public $nombreUtilisateurs;
    public $nombreProjets;

    public function __construct( array $data )
 {
        $this->chiffreAffaire = $data[ 'chiffre_affaire' ] ?? null;
        $this->nombreUtilisateurs = $data[ 'nombre_utilisateurs' ] ?? null;
        $this->nombreProjets = $data[ 'nombre_projets' ] ?? null;
    }
}
