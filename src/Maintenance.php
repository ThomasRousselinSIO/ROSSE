<?php

declare(strict_types=1);

namespace Rosse;

use LogicException;

final class Maintenance
{
    private Collection $lesVisites;

    public function __construct(
        private Collection $lesStations,
        private Collection $lesTechniciens
    ) {
        $this->lesVisites = new Collection();
    }

    public function réviser(): void
    {
        foreach ($this->lesStations as $station) {
            $visite = $station->getVisiteAFaire();
            if ($visite !== null) {
                $this->lesVisites->ajouter($visite);
            }
        }
    }

    public function affecterVisites(): void
    {
        if ($this->lesTechniciens->cardinal() === 0 && $this->lesVisites->cardinal() > 0) {
            throw new LogicException('Impossible d’affecter des visites sans technicien.');
        }

        foreach ($this->lesVisites as $visite) {
            if ($visite->getEtat() !== 'p') {
                continue;
            }

            $technicienLeMoinsOccupé = null;
            foreach ($this->lesTechniciens as $technicien) {
                if ($technicienLeMoinsOccupé === null
                    || $technicien->getTempsOccupé() < $technicienLeMoinsOccupé->getTempsOccupé()) {
                    $technicienLeMoinsOccupé = $technicien;
                }
            }

            $technicienLeMoinsOccupé->affecterVisite($visite);
            $visite->changerEtat();
        }
    }

    public function getLesVisites(): Collection
    {
        return $this->lesVisites;
    }
}

