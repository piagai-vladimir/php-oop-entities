<?php

class Chicken extends Biological
{
    protected function handleDeath(): void {
        echo "Курица {$this->name} издохла.<br>";
    }
    public function layEgg(): void {
        echo "Курица {$this->name} снесла яйцо.<br>";
    }
}