<?php

class Sheep extends Biological
{
    protected function handleDeath(): void {
        echo "Овца {$this->name} умерла.<br>";
    }
    public function shear(): void {
        echo "Овцу {$this->name} подстригли.<br>";
    }
}