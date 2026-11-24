<?php
namespace AgroManager\Physicals\Equipments;

use AgroManager\Physicals\Physical;
use AgroManager\Physicals\Equipments\Equipment;
use AgroManager\Contracts\PoweredInterface;
final class Tractor extends Equipment
{
    //атрибут #[Override] (PHP 8.3+) говорит IDE, что мы переопределяем метод родителя
    #[Override]
    public function attachTo(Physical $physical): Tractor {
        //при прикреплении трактор изнашивается на 1.0
        $this->applyWear($this->wear + 1.0);
        return $this; //возвращаю $this для Fluent Interface
    }

    #[Override]
    public function service(): Tractor {
        parent::service(); //сначала вызываем базовую логику (сброс износа)
        $this->refuel(50.0); //доливаю 50 единиц топлива
        return $this; //ковариантность: возвращаю Tractor вместо Physical
    }
}