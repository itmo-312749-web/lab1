<?php

namespace App;

class UserDataValidator implements Validator {
    private ?string $x;
    private ?string $y;
    private ?string $radius;

    public function __construct(
        ?string $x,
        ?string $y,
        ?string $radius
    ) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    private function isXValid(): bool {
        $validXValues = [-4, -3, -2, -1, 0, 1, 2, 3, 4];
        if ($this->x !== null && in_array(needle: $this->x, haystack: $validXValues))
            return true;
        return false;
    }

    private function isYValid(): bool {
        if (is_numeric($this->y) && -3 <= $this->y && $this->y <= 3)
            return true;
        return false;
    }

    private function isRadiusValid(): bool {
        $validRadiusValues = [1.0, 1.5, 2.0, 2.5, 3.0];
        if (in_array(needle: $this->radius, haystack: $validRadiusValues))
            return true;
        return false;
    }

    public function isValid(): bool {
        if ($this->radius !== null && $this->isXValid() && $this->isYValid() && $this->isRadiusValid())
            return true;
        return false;
    }
}