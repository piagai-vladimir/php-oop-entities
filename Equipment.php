<?php

//namespace Equipments;

$dirName = __DIR__; //получаю текущую директорию
$physical = $dirName . "/../Physical.php"; //формирую путь на уровень выше

//проверяю, существует ли файл, чтоб не словить фаталку
if(file_exists($physical)) {
    require_once($physical);
    echo "\nФайл |{$physical}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

$dirName = __DIR__; //получаю текущую директорию
$powered = $dirName . "/../../Contracts/PoweredInterface.php"; //формирую путь на уровень выше

//проверяю, существует ли файл, чтоб не словить фаталку
if(file_exists($powered)) {
    require_once($powered);
    echo "\nФайл |{$powered}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

//объявляю абстрактный класс Equipment.
//наследуюсь от Physical и реализую интерфейс PoweredInterface.
abstract class Equipment extends Physical implements PoweredInterface
{
    //тут я использую современный синтаксис PHP (Property Hooks).
    //создаю защищенное свойство уровня топлива и сразу пишу для него сеттер.
    public protected(set) float $fuelLevel = 0.0{
        set(float $value){
            $this->fuelLevel = $value;
        }
    }

    //метод, который просто возвращает текущий уровень топлива в процентах.
    //этот метод требует интерфейс PoweredInterface.
    public function getPercentage(): float
    {
        return $this->fuelLevel;
    }

    //метод для заправки. Принимает количество топлива.
    public function refuel(float $units): void
    {
        //если пытаются залить отрицательное значение или ноль - кидаю исключение.
        //заправлять можно только положительным числом!
        if($units <= 0.0){
            throw new \InvalidArgumentException("Значение может быть только положительным");
        }
    }

    //переопределяю метод service() из родительского класса.
    //использую атрибут #[Override] и меняю сигнатуру (возвращаемый тип Equipment),
    //это работает по правилу ковариантности (тип может быть более узким).
    #[\Override]
    public function service(): Equipment
    //переопределение сигнатуры по правилу ковариантности
    {
        parent::service(); //вызываю логику родителя
        return $this; //возвращаю себя же
    }
}