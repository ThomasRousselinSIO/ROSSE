<?php

declare(strict_types=1);

namespace Rosse;

use InvalidArgumentException;

final class Visite
{
    private string $état = 'p';
    private int $duréeTotale = 0;

    public function __construct(
        private Collection $lesBornes,
        private Station $laStation
    ) {
        foreach ($lesBornes as $borne) {
            $this->duréeTotale += $borne->getDuréeRévision();
        }
    }

    public function getDuréeTotale(): int
    {
        return $this->duréeTotale;
    }

    public function getEtat(): string
    {
        return $this->état;
    }

    public function getStation(): Station
    {
        return $this->laStation;
    }

    public function changerEtat(): void
    {
        if ($this->état === 'p') {
            $this->état = 'a';
            return;
        }
        if ($this->état === 'a') {
            $this->état = 'r';
            return;
        }

        throw new InvalidArgumentException('Une visite réalisée ne peut plus changer d’état.');
    }
}

