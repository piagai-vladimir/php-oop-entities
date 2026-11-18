<?php

class Seeder extends Equipment
{
    public function attachTo(Physical $physical): Physical {
        $this->applyWear($this->wear + 0.5);
        return $this;
    }

    public function service(): Physical {
        parent::service();
        $this->refuel(30.0);
        return $this;
    }
}
