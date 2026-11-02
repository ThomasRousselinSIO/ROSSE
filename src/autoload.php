<?php

declare(strict_types=1);

spl_autoload_register(static function (string $classe): void {
    $préfixe = 'Rosse\\';
    if (strncmp($classe, $préfixe, strlen($préfixe)) !== 0) {
        return;
    }

    $fichier = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, substr($classe, strlen($préfixe))) . '.php';
    if (!is_file($fichier)) {
        throw new RuntimeException("Classe introuvable : $classe");
    }

    require_once $fichier;
});

