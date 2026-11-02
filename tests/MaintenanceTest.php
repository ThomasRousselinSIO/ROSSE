<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/autoload.php';

use Rosse\Borne;
use Rosse\Collection;
use Rosse\Date;
use Rosse\Maintenance;
use Rosse\Station;
use Rosse\Technicien;
use Rosse\TypeBorne;

function vérifier(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$type = new TypeBorne(' rapide ', 30, 30, 100);
$bornesStation1 = new Collection();
$bornesStation1->ajouter(new Borne(1, new Date(2026, 1, 1), 0, $type));
$bornesStation1->ajouter(new Borne(2, new Date(2026, 10, 1), 100, $type));
$bornesStation2 = new Collection();
$bornesStation2->ajouter(new Borne(3, new Date(2026, 1, 1), 0, $type));
$bornesStation2->ajouter(new Borne(4, new Date(2026, 1, 1), 0, $type));

$stations = new Collection();
$stations->ajouter(new Station(1, 'Centre-ville', $bornesStation1));
$stations->ajouter(new Station(2, 'Gare', $bornesStation2));

$techniciens = new Collection();
$technicien1 = new Technicien(101, 'Dupont', 'Alice');
$technicien2 = new Technicien(102, 'Martin', 'Bob');
$techniciens->ajouter($technicien1);
$techniciens->ajouter($technicien2);

$maintenance = new Maintenance($stations, $techniciens);
$maintenance->réviser();
$maintenance->affecterVisites();

$visites = $maintenance->getLesVisites();
vérifier($visites->cardinal() === 2, 'Deux visites auraient dû être programmées.');
foreach ($visites as $visite) {
    vérifier($visite->getEtat() === 'a', 'Chaque visite doit être affectée.');
    vérifier($visite->getDuréeTotale() === 60, 'Chaque visite doit durer 60 minutes.');
}
vérifier($technicien1->getTempsOccupé() === 60, 'Le premier technicien doit recevoir une visite.');
vérifier($technicien2->getTempsOccupé() === 60, 'Le second technicien doit recevoir une visite.');

echo "OK - {$visites->cardinal()} visites affectées équitablement.\n";
