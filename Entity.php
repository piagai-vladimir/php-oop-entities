<?php

abstract class Entity {
    public string $id{
        set(string $value){
            $trimmed = trim($value);
            if ($trimmed === ''){
                throw new \InvalidArgumentException(
                    "ID не может быть пустым");
            }
            $this->id = $trimmed;
        }
    }
    
    public string $name{
        set(string $value){

        $trimmed = trim($value);
        if ($trimmed === ''){
            throw new \InvalidArgumentException(
                "Поле Name не может быть пустым");
        }

        $this->name = $trimmed;
        }
    }

    public function __construct(string $id, string $name) {
        $this->id = $id; // хуки запускаются автоматически
        $this->name = $name;
    }

}