<?php
namespace AgroManager\Biologicals\Animals;

use AgroManager\Biologicals\Biological;
use AgroManager\Contracts\FeedableInterface;

class Sheep extends Biological
{
    private float $woolAmount = 5.0;

    public function shear(): float
    {
        $harvestedWool = $this->woolAmount;
        $this->woolAmount = 0.0;
        return $harvestedWool;
    }

    public function growWool(float $amount): void
    {
        $this->woolAmount += $amount;
    }

    public function getWoolAmount(): float
    {
        return $this->woolAmount;
    }

    public function handleDeath(): void
    {
        echo "Овца по имени {$this->name} умерла.\n";
    }
}
