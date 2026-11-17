<?php

class Cow extends Biological
{
    protected function handleDeath(): void {
        echo "Корова {$this->name} пала.<br>";
    }
    public function giveMilk(): void {
        echo "Корова {$this->name} дает молоко.<br>";
    }
}