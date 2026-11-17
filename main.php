<?php

//включаю ошибки на всякий случай
ini_set('display_errors', 1);
error_reporting(E_ALL);

//оригинальный код подключения
$dir = __DIR__;
$entity = $dir . '/Entity.php';
$Biological = $dir . '/Biologicals/Biological.php';

if (file_exists($entity)) {
    require_once $entity;
    echo "Файл '" . $entity . "' подключен<br>";
}

if (file_exists($Biological)) {
    require_once $Biological;
    echo "Файл '" . $Biological . "' подключен<br>";
}

$cowPath = $dir . '/Biologicals/Animals/Cow.php';

if (file_exists($cowPath)) {
    require_once $cowPath;
    echo "Файл '" . $cowPath . "' подключен<br>";
} else {
    die("Ошибка: Файл Cow.php не найден!");
}

$realData = [
    "Буренка",  //1-й параметр (например, кличка или ID)
    5,          //2-й параметр (например, возраст)
    500.5       //3-й параметр (например, вес)
];

try {
    //узнаю, сколько параметров требует конструктор
    $reflection = new ReflectionClass('Cow');
    $constructor = $reflection->getConstructor();
    $requiredCount = $constructor ? $constructor->getNumberOfRequiredParameters() : 0;

    //беру из нашего массива ровно столько данных, сколько нужно классу
    $argsForConstructor = array_slice($realData, 0, $requiredCount);

    //если вписал меньше данных, чем требует класс, код сам добавит тестовые, чтобы не было ошибки
    while (count($argsForConstructor) < $requiredCount) {
        $argsForConstructor[] = "Тест_заглушка";
    }

    //создаю объект с реальными данными
    $myCow = $reflection->newInstanceArgs($argsForConstructor);

    //вывожу результат
    echo "<h3>Объект Cow создан с реальными данными:</h3>";
    echo "<pre>";
    print_r($myCow);
    echo "</pre>";

    //вызов метода changeHealth с отрицательным значением
    echo "<hr>";
    echo "<h3>Вызываю changeHealth(-15)...</h3>";

    if (method_exists($myCow, 'changeHealth')) {
        //передаю отрицательное значение
        $myCow->changeHealth(-9999);
        echo "Метод changeHealth(-9999) успешно выполнен!<br>";
    } else {
        echo "<b>Ошибка:</b> В классе Cow нет метода changeHealth!<br>";
    }

    //вывожу результат после изменения
    echo "<h3>Состояние объекта ПОСЛЕ вызова:</h3>";
    echo "<pre>";
    print_r($myCow);
    echo "</pre>";

} catch (Throwable $e) {
    echo "<b>Ошибка:</b> " . $e->getMessage();
}
?>