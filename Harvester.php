<?php

class Harvester extends Equipment
{
    public function attachTo(Physical $physical): Physical {
        $this->applyWear($this->wear + 2.0);
        return $this;
    }

    public function service(): Physical {
        parent::service();
        $this->refuel(80.0);
        return $this;
    }
}