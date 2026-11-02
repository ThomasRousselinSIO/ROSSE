<?php

declare(strict_types=1);

namespace Rosse;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

final class Collection implements Countable, IteratorAggregate
{
    /** @var list<object> */
    private array $objets = [];

    public function ajouter(object $objet): void
    {
        $this->objets[] = $objet;
    }

    public function cardinal(): int
    {
        return count($this->objets);
    }

    public function obtenirObjet(int $index): object
    {
        if ($index < 1 || $index > $this->cardinal()) {
            throw new InvalidArgumentException('L’index doit être compris entre 1 et cardinal().');
        }

        return $this->objets[$index - 1];
    }

    public function count(): int
    {
        return $this->cardinal();
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->objets);
    }
}

