<?php

namespace App\checkers;

class ThirdChecker extends AbstractChecker {
    public function check(): bool {
        return $this->x <= 0 && $this->y <= 0 &&
            ($this->x ** 2) + ($this->y ** 2) <= ($this->radius ** 2);
    }
}