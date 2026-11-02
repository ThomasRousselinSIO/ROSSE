<?php

declare(strict_types=1);

namespace Rosse;

use InvalidArgumentException;

final class TypeBorne
{
    public function __construct(
        private string $codeTypeBorne,
        private int $duréeRévision,
        private int $nbJoursEntreRévisions,
        private int $nbUnitésEntreRévisions
    ) {
        if ($duréeRévision < 0 || $nbJoursEntreRévisions < 0 || $nbUnitésEntreRévisions < 0) {
            throw new InvalidArgumentException('Les seuils d’un type de borne ne peuvent pas être négatifs.');
        }
    }

    public function getDuréeRévision(): int
    {
        return $this->duréeRévision;
    }

    public function getNbJoursEntreRévisions(): int
    {
        return $this->nbJoursEntreRévisions;
    }

    public function getNbUnitésEntreRévisions(): int
    {
        return $this->nbUnitésEntreRévisions;
    }
}

