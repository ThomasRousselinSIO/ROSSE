# TP3 ROSSE

Implémentation PHP orientée objet de la programmation et de l'affectation des
visites de maintenance préventive des bornes de recharge.

## Exécution

Depuis ce dossier, lancer :

```text
php tests\MaintenanceTest.php
```

Le script affiche les visites programmées et leur technicien affecté. Il
retourne un code d'erreur si une règle de l'énoncé n'est pas respectée.

## Organisation

- `src/` contient les classes métier et les classes techniques `Date` et
  `Collection`.
- `tests/` contient un scénario reproductible sans base de données.

