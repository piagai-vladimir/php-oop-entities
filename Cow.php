<?php

//namespace Animals;

$dirName = __DIR__;
$biological = $dirName . "/../Biological.php";


if(file_exists($biological)) {
    require_once($biological);
    echo "\nФайл |{$biological}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

$dirName = __DIR__;
$feedable = $dirName . "/../../Contracts/FeedableInterface.php";


if(file_exists($feedable)) {
    require_once($feedable);
    echo "\nФайл |{$feedable}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

final class Cow extends Biological implements FeedableInterface
{
    public const float WEIGHT_GAIN_COEFFICIENT = 0.1;
    public private(set) float $weightKg{
        set(float $value){
            if($value <= 0.0){
                throw new \InvalidArgumentException("Вес - это положительная величина");
            }
            $this->weightKg = $value;
        }
    }
    //виртуальное свойство значение вычисляется динамически
    public bool $isHealthy{
        get => $this->health > 50.0;
    }

    public function __construct(string $id, string $name, float $initialWeight)
    {
        parent::__construct($id, $name);
        $this->weightKg = $initialWeight;
    }

    public function feed(float $kg): void
    {
        if($kg <= 0.0) {
            throw new \InvalidArgumentException("Недостаточно корма");
        }

        $this->weightKg += ($kg * self::WEIGHT_GAIN_COEFFICIENT);
        $this->health = min(100.0, $this->health + 2.0);
        //$this->health = $this->changeHealth(2.0);

    }

    #[\Override]
    protected function handleDeath(): void
    {
        $this->weightKg = 0.0;
        echo "Животное с ID:{$this->id}  отправлено на колбасу";
    }
}