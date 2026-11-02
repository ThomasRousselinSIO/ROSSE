<?php

declare(strict_types=1);

namespace Rosse;

final class Borne
{
    public function __construct(
        private int $idBorne,
        private Date $dateDernièreRévision,
        private int $indiceCompteurUnités,
        private TypeBorne $leType
    ) {
    }

    public function getDuréeRévision(): int
    {
        return $this->leType->getDuréeRévision();
    }

    public function estARéviser(): bool
    {
        $joursÉcoulés = Date::aujourdhui()->différence($this->dateDernièreRévision);
        return $joursÉcoulés >= $this->leType->getNbJoursEntreRévisions()
            || $this->indiceCompteurUnités >= $this->leType->getNbUnitésEntreRévisions();
    }
}

