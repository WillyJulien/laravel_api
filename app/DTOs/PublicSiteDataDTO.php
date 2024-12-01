<?php

namespace App\DTOs;

class PublicSiteDataDTO
{
    private $data = [];

    public function __construct(array $public_datas)
    {
        // On attend ici que les données soient déjà formatées
        foreach ($public_datas as $key => $value) {
            $this->data[] = [
                'slug' => $key,
                'value' => $value ?? null // Utilisation de null si la valeur est absente
            ];
        }
    }

    // Getter pour récupérer toutes les données
    public function getAllData(): array
    {
        return $this->data;
    }

    // Getter pour récupérer une donnée spécifique par son slug
    public function getDataBySlug(string $slug)
    {
        foreach ($this->data as $entry) {
            if ($entry['slug'] === $slug) {
                return $entry['value'];
            }
        }

        return null; // Retourne null si le slug n'existe pas
    }

    // Setter pour modifier une donnée existante
    public function setData(string $slug, $value)
    {
        foreach ($this->data as &$entry) {
            if ($entry['slug'] === $slug) {
                $entry['value'] = $value;
                return;
            }
        }

        // Si le slug n'existe pas, on l'ajoute
        $this->data[] = [
            'slug' => $slug,
            'value' => $value
        ];
    }
}
