<?php

//наследуюсь от Physical и реализуем интерфейс PoweredInterface
abstract class Equipment extends Physical implements PoweredInterface
{
    //хук свойства уровня топлива
    public protected(set) float $fuelLevel = 0.0 {
        set(float $value) {
            //ограничиваю топливо от 0 до 100
            $this->fuelLevel = max(0.0, min(100.0, $value));
        }
    }

    //реализация метода из интерфейса
    public function getPercentage(): float {
        return $this->fuelLevel;
    }

    //реализация метода из интерфейса (static возвращает тип текущего класса)
    public function refuel(float $amount): static {
        $this->fuelLevel += $amount;
        return $this;
    }
}