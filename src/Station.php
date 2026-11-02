<?php

declare(strict_types=1);

namespace Rosse;

final class Station
{
    public function __construct(
        private int $idStation,
        private string $libelléEmplacement,
        private Collection $lesBornes
    ) {
    }

    public function getId(): int
    {
        return $this->idStation;
    }

    public function getLibelléEmplacement(): string
    {
        return $this->libelléEmplacement;
    }

    public function getVisiteAFaire(): ?Visite
    {
        $bornesÀRéviser = new Collection();
        foreach ($this->lesBornes as $borne) {
            if ($borne->estARéviser()) {
                $bornesÀRéviser->ajouter($borne);
            }
        }

        return $bornesÀRéviser->cardinal() === 0 ? null : new Visite($bornesÀRéviser, $this);
    }
}

