<?php
namespace AgroManager\Biologicals\Animals;

use AgroManager\Biologicals\Biological;
use AgroManager\Contracts\FeedableInterface;

class Chicken extends Biological
{
    private int $eggsLaid = 0;

    public function layEgg(): void
    {
        $this->eggsLaid++;
    }

    public function getEggsLaid(): int
    {
        return $this->eggsLaid;
    }

    public function handleDeath(): void
    {
        echo "Курица по имени {$this->name} умерла.\n";
    }
}
