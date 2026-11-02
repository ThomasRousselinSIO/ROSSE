<?php

declare(strict_types=1);

namespace Rosse;

final class Technicien
{
    private Collection $lesVisites;

    public function __construct(
        private int $matricule,
        private string $nom,
        private string $prénom
    ) {
        $this->lesVisites = new Collection();
    }

    public function getTempsOccupé(): int
    {
        $temps = 0;
        foreach ($this->lesVisites as $visite) {
            $temps += $visite->getDuréeTotale();
        }
        return $temps;
    }

    public function affecterVisite(Visite $uneVisite): void
    {
        $this->lesVisites->ajouter($uneVisite);
    }

    public function getLesVisites(): Collection
    {
        return $this->lesVisites;
    }

    public function getMatricule(): int
    {
        return $this->matricule;
    }

    public function getNomComplet(): string
    {
        return $this->prénom . ' ' . $this->nom;
    }
}

