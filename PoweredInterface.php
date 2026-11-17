<?php

interface PoweredInterface
{
    public function getPercentage(): float;
    public function refuel(float $amount): static;
}