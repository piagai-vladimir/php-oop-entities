<?php

//создаю абстрактный класс. Напрямую создать объект нельзя, только наследовать.
abstract class Entity {
    //использую хуки свойств (Property Hooks) из PHP 8.5.
    //хук set срабатывает при попытке записать значение.
    public string $id{
        set(string $value){
            $trimmed = trim($value); //убираю лишние пробелы по краям
            if ($trimmed === ''){
                //валидация: если строка пустая, кидаю исключение
                throw new \InvalidArgumentException(
                    "ID не может быть пустым");
            }
            $this->id = $trimmed; //присваиваю очищенное значение
        }
    }
    
    public string $name{
        set(string $value){

        $trimmed = trim($value);
        if ($trimmed === ''){
            //валидация для имени
            throw new \InvalidArgumentException(
                "Поле Name не может быть пустым");
        }

        $this->name = $trimmed;
        }
    }

    //магический метод конструктор. Вызывается автоматически при создании объекта.
    public function __construct(string $id, string $name) {
        //присваиваю значения. Благодаря хукам выше (set),
        //валидация запустится автоматически при записи.
        $this->id = $id; // хуки запускаются автоматически
        $this->name = $name;
    }

}