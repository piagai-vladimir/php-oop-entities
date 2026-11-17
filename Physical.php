<?php

//namespace Physicals;

$dirName = __DIR__; //получаю текущую директорию
$entity = $dirName . "/../Entity.php"; //формирую путь на уровень выше

//проверяю, существует ли файл, чтоб не словить фаталку
if(file_exists($entity)) {
    require_once($entity);
    echo "\nФайл |{$entity}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

//класс Physical наследуется от Entity. Абстрактный.
abstract class Physical extends Entity
{
    //хук свойства износа (wear). По умолчанию 0.
    public protected(set) float $wear = 0.0{
        set(float $value){
            //валидация: износ не может быть меньше 0 или больше 100
            if($value < 0.0 || $value > 100.0){
                //если значение некорректное, выбрасываю исключение
                throw new \OutOfRangeException("Износ может принимать значения от 0 до 100");
            }
            $this->wear = $value;
        }
    }

    //метод обслуживания (ремонта) объекта
    public function service(): Physical
    {
        //сбрасываю износ до нуля (сработает хук set и пропустит значение 0)
        $this->wear = 0.0;
        return $this; //возвращаю $this для реализации паттерна "Fluent Interface" (цепочек вызовов)
    }

    //абстрактный метод. У физических объектов есть логика прикрепления к другим объектам.
    //наследники обязаны его реализовать.
    abstract public function attachTo(Physical $physical): Physical;

}