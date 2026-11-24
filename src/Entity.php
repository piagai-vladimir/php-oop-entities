<?php

//абстрактный класс. Напрямую создать объект нельзя, только наследовать.
abstract class Entity
{
    //использую хуки свойств (Property Hooks) из PHP 8.4
    public string $id {
        set(string $value) {
            $trimmed = trim($value); // Убираем лишние пробелы
            if ($trimmed === '') {
                // Валидация: если строка пустая, кидаем исключение
                throw new \InvalidArgumentException("ID не может быть пустым");
            }
            $this->id = $trimmed; // Присваиваем очищенное значение
        }
    }

    public string $name {
        set(string $value) {
            $trimmed = trim($value);
            if ($trimmed === '') {
                throw new \InvalidArgumentException("Поле Name не может быть пустым");
            }
            $this->name = $trimmed;
        }
    }

    //магический метод конструктор
    public function __construct(string $id, string $name)
    {
        //благодаря хукам выше, валидация запустится автоматически при записи
        $this->id = $id;
        $this->name = $name;
    }
}
