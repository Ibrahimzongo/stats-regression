
# Statistic Regression

[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue)](https://www.php.net/)
[![Packagist Version](https://img.shields.io/packagist/v/azongo/statistic-regression)](https://packagist.org/packages/azongo/statistic-regression)
[![License](https://img.shields.io/github/license/Ibrahimzongo/statistic-regression)](LICENSE)

**Statistic Regression** est une bibliothèque PHP simple pour la régression linéaire, qui aide à modéliser la relation entre une variable dépendante (Y) et une variable indépendante (X) à l'aide d'un modèle linéaire. Elle inclut des méthodes pour ajuster un modèle de régression, faire des prédictions, et extraire des statistiques clés comme la pente, l'intercept, les erreurs standards, et les valeurs `t`.

## Sommaire
- [Statistic Regression](#statistic-regression)
  - [Sommaire](#sommaire)
  - [Fonctionnalités](#fonctionnalités)
  - [Prérequis](#prérequis)
  - [Installation](#installation)
  - [Utilisation](#utilisation)
  - [Tests](#tests)
  - [Contribution](#contribution)
  - [Auteur](#auteur)
  - [Licence](#licence)

---

## Fonctionnalités

- **Ajustement de modèle** : ajuste une régression linéaire simple à partir de deux séries de données.
- **Prédictions** : génère des prédictions basées sur le modèle ajusté.
- **Statistiques de régression** :
  - **Pente (Slope)** et **Ordonnée à l'origine (Intercept)**
  - **Erreurs standards** pour la pente et l'ordonnée à l'origine
  - **Valeurs t** pour tester la significativité des coefficients

## Prérequis

- **PHP** >= 7.4
- **Composer** pour la gestion des dépendances
- **PHPUnit** pour exécuter les tests unitaires

## Installation

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/Ibrahimzongo/statistic-regression.git
   cd statistic-regression
   ```
2. Installez les dépendances :
   ```bash
   composer install
   ```

## Utilisation

Voici un exemple simple d'utilisation de la classe `SimpleLinearRegression` :

```php
require 'vendor/autoload.php';

use Statistics\Regression\SimpleLinearRegression;

$x = [1, 2, 3, 4, 5];
$y = [1.5, 2.5, 2.8, 3.6, 3.9];

$regression = new SimpleLinearRegression();
$regression->fit($x, $y);

echo "Pente (Slope) : " . $regression->getSlope() . PHP_EOL;
echo "Ordonnée à l'origine (Intercept) : " . $regression->getIntercept() . PHP_EOL;
echo "Erreur standard pour la pente : " . $regression->getStdErrorSlope() . PHP_EOL;
echo "Erreur standard pour l'ordonnée : " . $regression->getStdErrorIntercept() . PHP_EOL;

$predictedY = $regression->predict(6);
echo "Prédiction pour x=6 : " . $predictedY . PHP_EOL;
```

## Tests

Pour exécuter les tests unitaires, utilisez l'une des commandes suivantes :

```bash
# Directement avec PHPUnit
vendor/bin/phpunit

# Ou avec Composer 
composer test
```

## Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalite`).
3. Commitez vos modifications (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`).
4. Pushez vers la branche (`git push origin feature/nouvelle-fonctionnalite`).
5. Créez une Pull Request.

N'hésitez pas à ouvrir une issue pour rapporter un bug ou proposer une amélioration.

## Auteur

Créé par [Ibrahim Zongo](https://github.com/Ibrahimzongo).

## Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.
