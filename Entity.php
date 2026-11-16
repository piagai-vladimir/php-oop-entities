<?php

//класс не может быть инстанцирован напрямую
//(нельзя создать объект напрямую через new Entity() )
abstract class Entity {

//инкапсуляция - механизм объединения даных и методов внутри одного класса,
//с сокрытием внутреннего состояния от прямого внешнего вмешательства
    protected string $id;
    protected string $name;

    //конструктор. При создании объекта сразу задаем ему айди и имя.
    public function _construct(string $id, string $name) {
        $this->setID($id);
        $this->setName($name);
    }

    //сеттер для ID.
    protected function setID(string $id): void
    {
        $trimmed = trim($id); //обрезаю пробелы по бокам
        if ($trimmed === ''){
            //если айди пустой - кидаем эксепшн (выбрасываем ошибку)
            throw new \InvalidArgumentException("ID не может быть пустым")
        }
        $this->id = $trimmed; //записываю в свойство
    }

    //геттер для ID. Просто отдаем то, что лежит в свойстве.
    public function getID(): string
    {
        return $this->id;
    }

    //сеттер для имени.
    protected function setName(string $name): void
    {
        $trimmed = trim($name);
        if ($trimmed === ''){
            throw new \InvalidArgumentException("Именование не может быть пустым")
        }
        $this->name = $trimmed;
    }

    //геттер для имени.
    public function getName(): string
    {
        return $this->name;
    }
}