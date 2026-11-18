<?php

//аналогично предыдущему файлу, создаю интерфейс для тех, кого можно кормить.
interface FeedableInterface {
    //контракт: метод feed принимает вес еды (кг) и ничего не возвращает.
    public function feed(float $kg): void;
}
