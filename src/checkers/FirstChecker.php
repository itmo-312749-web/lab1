<?php

namespace App\checkers;

class FirstChecker extends AbstractChecker {
    public function check(): bool {
        return 0 <= $this->x && 0 <= $this->y &&
            $this->y <= (-1/2) * $this->x + ($this->radius);
    }
}