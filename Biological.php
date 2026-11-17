<?php

//подключаю родительский класс Entity.php
$dirName = __DIR__; //получаю текущую директорию
$entity = $dirName . "/../Entity.php"; //формирую путь на уровень выше

//проверяю, существует ли файл, чтоб не словить фаталку
if(file_exists($entity)) {
    require_once($entity);
    echo "\nФайл |{$entity}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

//класс Biological наследуется от Entity. Он тоже абстрактный.
abstract class Biological extends Entity
{
    //хук свойства здоровья.
    //public protected(set) значит: читать можно отовсюду, а менять только внутри класса и наследников
    public protected(set) float $health = 100.0{
        set(float $value){
            //ограничиваю здоровье диапазоном от 0 до 100 с помощью max и min
            $this->health = max(0.0, min(100.0, $value));

            //если здоровье упало до нуля, вызываю логику смерти
            if ($this->health === 0.0)
            {
                echo "Объект с ID:{$this->id} умер.";
                $this->handleDeath(); //вызов абстрактного метода (реализация будет в дочерних классах)
            }
        }
    }

    public function __construct(string $id, string $name){
        //вызываю конструктор родителя (Entity), чтобы он проверил и сохранил id и name
        parent::__construct($id, $name);
    }
    // public function getHealth(): float
    // {
    //    return $this->health;
    // }

    //метод для изменения здоровья (получение урона или лечение)
    public function changeHealth(float $delta): void
    {
        //прибавляю/отнимаю значение.
        //автоматически сработает хук set выше, который ограничит значения и проверит на смерть.
        $this->health += $delta;
        
    }

    //абстрактный метод. Обязывает всех наследников написать свою реализацию смерти.
    abstract protected function handleDeath(): void;

}