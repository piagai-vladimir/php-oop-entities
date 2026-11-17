<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//базовый путь - папка, где лежит main.php (AgroManager_3)
$base = __DIR__;

//массив файлов в строгом порядке (от родителей к детям)
$filesToLoad = [
    //базовые классы и интерфейсы
    $base . '/Entity.php',
    $base . '/Contracts/PoweredInterface.php',
    $base . '/Biologicals/Biological.php',
    $base . '/Physical.php',

    //оборудование (с учетом папки Physicals)
    $base . '/Physicals/Equipments/Equipment.php',

    //наследники Biological
    $base . '/Biologicals/Animals/Cow.php',
    $base . '/Biologicals/Animals/Sheep.php',
    $base . '/Biologicals/Animals/Chicken.php',

    //наследники Equipment
    $base . '/Physicals/Equipments/Tractor.php',
    $base . '/Physicals/Equipments/Harvester.php',
    $base . '/Physicals/Equipments/Seeder.php'
];

//безопасное подключение
foreach ($filesToLoad as $filePath) {
    if (file_exists($filePath)) {
        require_once $filePath;
    } else {
        die("<b style='color:red;'>Фатальная ошибка:</b> Не найден файл по пути: <i>{$filePath}</i>");
    }
}


//логика работы
echo "<h2>Биологические объекты</h2>";
try {
    //создаю объекты
    $cow = new Cow("BIO-1", "Буренка");
    $sheep = new Sheep("BIO-2", "Долли");
    $chicken = new Chicken("BIO-3", "Ряба");

    //вызываю уникальные методы
    $cow->giveMilk();
    $sheep->shear();
    $chicken->layEgg();

    //тестирую здоровье и смерть
    echo "<br>Наносим корове 50 урона...<br>";
    $cow->changeHealth(-50);

    echo "Наносим корове еще 50 урона (здоровье упадет до 0)...<br>";
    $cow->changeHealth(-50);

} catch (Throwable $e) {
    echo "<b>Ошибка:</b> " . $e->getMessage() . "<br>";
}

echo "<hr>";

echo "<h2>Оборудование</h2>";
try {
    //содзаю объекты
    $tractor = new Tractor("EQ-1", "Беларус");
    $harvester = new Harvester("EQ-2", "John Deere");
    $seeder = new Seeder("EQ-3", "Amazon");

    //тестирую Fluent Interface (цепочку вызовов)
    echo "Прикрепляем сеялку к трактору и делаем ТО...<br>";
    $seeder->attachTo($tractor)->service();
    echo "Топливо сеялки после ТО: " . $seeder->getPercentage() . "%<br>";

    //тестирую хук свойства (wear) через метод applyWear
    echo "<br>Меняем износ комбайна на 15.5...<br>";
    $harvester->applyWear(15.5);
    echo "Текущий износ комбайна: {$harvester->wear}%<br>";

    //тестирую выброс исключения при неверном износе
    echo "<br>Пытаемся установить износ комбайна 150% (ожидаем ошибку)...<br>";
    $harvester->applyWear(150);

} catch (OutOfRangeException $e) {
    echo "<b>Ошибка (Износ):</b> " . $e->getMessage() . "<br>";
} catch (Throwable $e) {
    echo "<b>Ошибка:</b> " . $e->getMessage() . "<br>";
}