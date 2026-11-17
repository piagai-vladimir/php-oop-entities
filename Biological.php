<?php

abstract class Biological extends Entity
{
    //хук свойства здоровья
    public protected(set) float $health = 100.0 {
        set(float $value) {
            //ограничиваю здоровье от 0 до 100 (max и min)
            $this->health = max(0.0, min(100.0, $value));

            //если здоровье упало до нуля, вызываю логику смерти
            if ($this->health === 0.0) {
                echo "Объект с ID:{$this->id} умер.<br>";
                $this->handleDeath(); //вызов абстрактного метода
            }
        }
    }

    public function __construct(string $id, string $name) {
        parent::__construct($id, $name); //вызываю конструктор родителя Entity
    }

    //метод для получения урона/лечения
    public function changeHealth(float $delta): void {
        $this->health += $delta; //изменение вызовет хук set выше
    }

    //абстрактный метод, каждый наследник сам решает, как "умирать"
    abstract protected function handleDeath(): void;
}