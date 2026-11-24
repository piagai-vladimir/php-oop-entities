<?php
namespace Biologicals\Animals;
use Biologicals\Biological;

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