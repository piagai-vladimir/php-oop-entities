<?php
namespace Physicals;
use Entity;
abstract class Physical extends Entity
{
    //protected(set) значит: читать можно всем, а менять только внутри класса и наследников.
    public protected(set) float $wear = 0.0 {
        set(float $value) {
            // Ограничиваем износ диапазоном от 0 до 100
            if ($value < 0.0 || $value > 100.0) {
                throw new \OutOfRangeException("Износ может принимать значения от 0 до 100");
            }
            $this->wear = $value;
        }
    }

    //метод сервисного обслуживания (сбрасывает износ)
    public function service(): Physical {
        $this->wear = 0.0;
        return $this; //возвращаю себя для цепочки вызовов
    }

    //публичный метод для изменения износа извне (обход protected(set))
    public function applyWear(float $amount): void {
        $this->wear = $amount;
    }

    //абстрактный метод, обязывающий наследников реализовать логику прикрепления
    abstract public function attachTo(Physical $physical): Physical;
}
