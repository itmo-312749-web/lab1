<?php

namespace App\checkers;

class SecondChecker extends AbstractChecker {
    public function check(): bool {
        return 0 <= $this->x && $this->x <= $this->radius &&
            -$this->radius <= $this->y && $this->y <= 0;
    }
}