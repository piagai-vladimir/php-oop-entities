<?php

//подключаю родительский класс Entity.php
$dirName = __DIR__; //получаю текущую директорию
$entity = $dirName . "/../Entity.php"; //формирую путь на уровень выше

//проверяю, существует ли файл, чтоб не словить фаталку
if(file_exists($entity)) {
    require_once($entity);
    echo "\nФайл |{$entity}| подключен!\n"
}else{
    echo "Ошибка в формировании адреса";
}

abstract class Biological extends Entity
{
    //разрешено чтение из вне, но запрещена запись во внешнем коде
    public protected(set) float $health = 100.0{
        set(float $value){
            $this->health = max(0.0, min(100.0, $value));
            if ($this->health === 0.0)
            {
                echo "Объект с ID:{$this->id} умер.";
                $this->handleDeath();
            }
        }
    };

    public function __construct(string $id, string $name){
        parent::__construct($id, $name);
    }
    // public function getHealth(): float
    // {
    //    return $this->health;
    // }

    public function changeHealth(float $delta): void
    {
        $this->health += $delta;
        
    }

    abstract protected function handleDeath(): void;

}