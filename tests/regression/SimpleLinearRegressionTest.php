<?php
// tests/SimpleLinearRegressionTest.php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Statistics\Regression\SimpleLinearRegression;

class SimpleLinearRegressionTest extends TestCase
{
    protected $regression;

    protected function setUp(): void
    {
        parent::setUp();
        // Initialisation d'une nouvelle instance de SimpleLinearRegression avant chaque test
        $this->regression = new SimpleLinearRegression();
    }

    public function testFit(): void
    {
        $x = [1, 2, 3, 4, 5];
        $y = [1.5, 2.5, 2.8, 3.6, 3.9];

        $this->regression->fit($x, $y);

        // Vérification des coefficients de régression
        $this->assertEquals(0.59, round($this->regression->getSlope(), 2), 'La pente (slope) doit être proche de 0.59');
        $this->assertEquals(1.09, round($this->regression->getIntercept(), 2), 'L\'intercept (intercept) doit être proche de 1.09');

        // Vérification des erreurs standard
        $this->assertEquals(0.06608075867199667, $this->regression->getStdErrorSlope(), 'L\'erreur standard pour la pente doit être proche de 0.06608075867199667');
        $this->assertEquals(0.21916508237703675, $this->regression->getStdErrorIntercept(), 'L\'erreur standard pour l\'intercept doit être proche de 0.21916508237703675');

        // Vérification des valeurs t
        $this->assertEquals(8.92846891980414, $this->regression->getTValueSlope(), 'La valeur t pour la pente doit être proche de 8.92846891980414');
        $this->assertEquals(4.973419981768984, $this->regression->getTValueIntercept(), 'La valeur t pour l\'intercept doit être proche de 4.973419981768984');

        // Vérification des valeurs p (approximatives)
        // $this->assertEquals(0.002, $this->regression->getPValueSlope(), 'La valeur p pour la pente doit être proche de 0.002');
        // $this->assertEquals(0.015, $this->regression->getPValueIntercept(), 'La valeur p pour l\'intercept doit être proche de 0.015');
    }

    public function testPredict(): void
    {
        $x = [1, 2, 3, 4, 5];
        $y = [1.5, 2.5, 2.8, 3.6, 3.9];

        $this->regression->fit($x, $y);

        // Prédiction pour une nouvelle valeur de X
        $newX = 6;
        $predictedY = $this->regression->predict($newX);

        // Vérification de la prédiction
        $this->assertEquals(4.63, round($predictedY, 2), 'La prédiction pour X=6 doit être proche de 4.63');
    }
}
