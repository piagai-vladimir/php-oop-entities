<?php

interface FeedableInterface {
    public function feed(float $kg): void;
}