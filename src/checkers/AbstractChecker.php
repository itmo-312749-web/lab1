<?php

namespace App\checkers;

abstract class AbstractChecker {
    protected float $x;
    protected float $y;
    protected float $radius;
    public function __construct(float $x, float $y, float $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public abstract function check(): bool;
}