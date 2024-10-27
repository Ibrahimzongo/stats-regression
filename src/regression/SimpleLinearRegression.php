<?php
// SimpleLinearRegression.php

namespace Statistics\Regression;

class SimpleLinearRegression
{
    protected $slope; // Coefficient de pente (b)
    protected $intercept; // Intercept (a)
    protected $stdErrorSlope; // Erreur standard pour la pente (b)
    protected $stdErrorIntercept; // Erreur standard pour l'intercept (a)
    protected $tValueSlope; // Valeur t pour la pente (b)
    protected $tValueIntercept; // Valeur t pour l'intercept (a)
    protected $pValueSlope; // Valeur p pour la pente (b)
    protected $pValueIntercept; // Valeur p pour l'intercept (a)

    public function fit(array $x, array $y)
    {
        // Vérifier que les tableaux $x et $y ont la même taille
        if (count($x) !== count($y)) {
            throw new \InvalidArgumentException("Les tableaux X et Y doivent avoir la même taille.");
        }

        $n = count($x);
        $sumX = array_sum($x);
        $sumY = array_sum($y);

        // Calcul des moyennes
        $meanX = $sumX / $n;
        $meanY = $sumY / $n;

        // Calcul des coefficients de régression
        $covXY = 0;
        $varX = 0;

        for ($i = 0; $i < $n; $i++) {
            $covXY += ($x[$i] - $meanX) * ($y[$i] - $meanY);
            $varX += pow(($x[$i] - $meanX), 2);
        }

        // Eviter la division par zéro
        if ($varX == 0) {
            throw new \RuntimeException("La variance de X ne peut pas être zéro.");
        }

        $this->slope = $covXY / $varX;
        $this->intercept = $meanY - $this->slope * $meanX;

        // Calcul des erreurs standard
        $residuals = [];
        for ($i = 0; $i < $n; $i++) {
            $predicted = $this->predict($x[$i]);
            $residuals[] = $y[$i] - $predicted;
        }

        $residualSumOfSquares = array_sum(array_map(function ($residual) {
            return pow($residual, 2);
        }, $residuals));

        // Erreur standard
        $standardError = sqrt($residualSumOfSquares / ($n - 2));

        // Erreur standard pour la pente (b)
        $this->stdErrorSlope = $standardError / sqrt($varX);

        // Erreur standard pour l'intercept (a)
        $this->stdErrorIntercept = $standardError * sqrt((1 / $n) + (pow($meanX, 2) / $varX));

        // Calcul des valeurs t
        $this->tValueSlope = $this->slope / $this->stdErrorSlope;
        $this->tValueIntercept = $this->intercept / $this->stdErrorIntercept;
    }

    protected function calculatePValue($tValue, $degreesOfFreedom)
    {
        // Implémentation simplifiée pour le calcul des p-values, en pratique,
        // on utiliserait une bibliothèque statistique pour ce calcul.
        // Ici, on retourne une valeur de p fictive pour la démonstration.
        return $tValue < 0 ? 1 : 0.05; // À affiner avec une vraie méthode de calcul
    }

    public function predict($x)
    {
        return $this->intercept + $this->slope * $x;
    }

    public function getSlope()
    {
        return $this->slope;
    }

    public function getIntercept()
    {
        return $this->intercept;
    }

    public function getStdErrorSlope()
    {
        return $this->stdErrorSlope;
    }

    public function getStdErrorIntercept()
    {
        return $this->stdErrorIntercept;
    }

    public function getTValueSlope()
    {
        return $this->tValueSlope;
    }

    public function getTValueIntercept()
    {
        return $this->tValueIntercept;
    }

    public function getPValueSlope()
    {
        return $this->pValueSlope;
    }

    public function getPValueIntercept()
    {
        return $this->pValueIntercept;
    }
}
