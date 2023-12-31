<?php

namespace App\Collector;

use Doctrine\Common\Collections\Collection;

final class TotalVatCalculator implements TotalCalculatorInterface
{
    private $flag = 'totalVat';

    public function calculate(Collection $orderItems): float
    {
        $totalVat = 0;

        foreach ($orderItems as $orderItem) {
            $price = $orderItem->getProduct()->getPrice();
            $totalVat += (($price * 1.23) - $price) * $orderItem->getQuantity(); 
        }

        return round($totalVat, 2);
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

}