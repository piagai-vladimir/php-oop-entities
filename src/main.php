<?php
spl_autoload_register(function ($class) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    echo "\nClass: {$className}\n";
    $file = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
    echo "\nFile {$file}\n";
    if (is_file($file)) {
        require_once $file;
    }
}, true, false);

use Biologicals\Animals\Cow;
use Biologicals\Animals\Chicken;
use Biologicals\Animals\Sheep;

//создание животных
$Murka = new Cow("1", "Мурка", 80.025);
$Tika = new Chicken("1", "Тика", 65.565);
$Meme = new Sheep("1", "Мэмэ", 70.890);

//демонстрация уникальных свойств:
$Tika->layEgg();
$Tika->layEgg();
$Tika->layEgg();
echo "Курица Тика снесла яиц: " . $Tika->getEggsLaid() . "\n";

echo "Шерсти у овцы Мэмэ до стрижки: " . $Meme->getWoolAmount() . " кг\n";
$shearedWool = $Meme->shear();
echo "Состригли: " . $shearedWool . " кг. Осталось: " . $Meme->getWoolAmount() . " кг\n";

//вывод животных
print_r($Murka);
print_r($Tika);
print_r($Meme);

