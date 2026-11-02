<?php

declare(strict_types=1);

namespace Rosse;

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

final class Date
{
    private DateTimeImmutable $date;

    public function __construct(int $annee, int $mois, int $jour)
    {
        $date = DateTimeImmutable::createFromFormat('!Y-n-j', "$annee-$mois-$jour");
        $erreurs = DateTimeImmutable::getLastErrors();
        if ($date === false || ($erreurs !== false && ($erreurs['warning_count'] > 0 || $erreurs['error_count'] > 0))) {
            throw new InvalidArgumentException('Date invalide.');
        }

        $this->date = $date;
    }

    public static function aujourdhui(): self
    {
        $date = new DateTimeImmutable('today');
        return new self((int) $date->format('Y'), (int) $date->format('n'), (int) $date->format('j'));
    }

    public function année(): int
    {
        return (int) $this->date->format('Y');
    }

    public function mois(): int
    {
        return (int) $this->date->format('n');
    }

    public function jour(): int
    {
        return (int) $this->date->format('j');
    }

    public function différence(self $uneDate): int
    {
        $difference = $uneDate->date->diff($this->date);
        $jours = (int) $difference->days;
        return $difference->invert === 1 ? -$jours : $jours;
    }

    public function toDateTime(): DateTimeInterface
    {
        return $this->date;
    }
}

