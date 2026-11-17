<?php

//namespace Animals;

//подключаю родительский класс Biological.php (поднимаюсь на уровень выше)
$dirName = __DIR__;
$biological = $dirName . "/../Biological.php";


if(file_exists($biological)) {
    require_once($biological);
    echo "\nФайл |{$biological}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

//подключаю интерфейс FeedableInterface.php (поднимаюсь на два уровня выше)
$dirName = __DIR__;
$feedable = $dirName . "/../../Contracts/FeedableInterface.php";


if(file_exists($feedable)) {
    require_once($feedable);
    echo "\nФайл |{$feedable}| подключен!\n";
}else{
    echo "Ошибка в формировании адреса";
}

//создаю финальный класс Корова (final, чтобы от него нельзя было наследоваться).
//наследуюсь от Biological и реализую интерфейс FeedableInterface (так как корову можно кормить).
final class Cow extends Biological implements FeedableInterface
{
    public const float WEIGHT_GAIN_COEFFICIENT = 0.1;

    //свойство веса с хуком сеттера.
    //проверяю, чтобы вес всегда был положительным, иначе кидаю исключение.
    public private(set) float $weightKg{
        set(float $value){
            if($value <= 0.0){
                throw new \InvalidArgumentException("Вес - это положительная величина");
            }
            $this->weightKg = $value;
        }
    }
    //виртуальное свойство значение вычисляется динамически
    //если здоровье больше 50, то корова считается здоровой.
    public bool $isHealthy{
        get => $this->health > 50.0;
    }

    //конструктор. Принимает id, имя и изначальный вес.
    //вызываю конструктор родителя (parent::__construct) и устанавливаю вес.
    public function __construct(string $id, string $name, float $initialWeight)
    {
        parent::__construct($id, $name);
        $this->weightKg = $initialWeight;
    }

    //реализую метод из интерфейса FeedableInterface.
    public function feed(float $kg): void
    {
        //если дают 0 или отрицательный корм - ошибка.
        if($kg <= 0.0) {
            throw new \InvalidArgumentException("Недостаточно корма");
        }

        //увеличиваю вес коровы в зависимости от коэффициента.
        $this->weightKg += ($kg * self::WEIGHT_GAIN_COEFFICIENT);

        //здоровье увеличивается на 2, но не может превысить 100.
        $this->health = min(100.0, $this->health + 2.0);

        //(закомментированный старый вариант изменения здоровья)
        //$this->health = $this->changeHealth(2.0);

    }

    //переопределяю метод обработки смерти из родительского класса.
    //опять использую атрибут для проверки, что метод реально есть у родителя.
    #[\Override]
    protected function handleDeath(): void
    {
        $this->weightKg = 0.0; //обнуляю вес
        //вывожу сообщение об отправке на колбасу. ID беру из родительского свойства.
        echo "Животное с ID:{$this->id}  отправлено на колбасу";
    }
}