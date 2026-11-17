<?php

//получаю текущую директорию скрипта
$dir = __DIR__;
//формирую абсолютные пути к подключаемым файлам
$entity = $dir . '/Entity.php';
$Biological = $dir . '/Biologicals/Biological.php';

//проверяю существование файла базового класса, чтобы не поймать фатальную ошибку
if (file_exists($entity)) {
    require_once $entity; //подключаю файл (require_once защищает от повторного подключения)
    echo "Файл '" . $entity . "' подключен";
}

//то же самое для класса-наследника
if (file_exists($Biological)) {
    require_once $Biological;
    echo "Файл '" . $Biological . "' подключен ";
}

//создаю объект класса Biological.
//использую именованные аргументы (id: ..., name: ...), чтобы было читаемо
$biological = new Biological("1", "First Ivan");
//вывожу содержимое объекта для проверки
print_r($biological);
