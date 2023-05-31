<?php

namespace App;

use DateTimeImmutable;
use DateTimeZone;

class Record {
    private float $x;
    private float $y;
    private float $radius;

    private array $checkers;
    private bool $isHit;
    private DateTimeImmutable $timestamp;
    private int $executionTime;
    public function __construct(
        float $x,
        float $y,
        float $radius,
        array $checkers,
    ) {
        //
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
        $this->checkers = $checkers;

        //
        $startTime = hrtime(as_number: true);
        $this->isHit = $this->setIsHit();
        $endTime = hrtime(as_number: true);

        $this->timestamp = new DateTimeImmutable(
            timezone: new DateTimeZone("Europe/Moscow")
        );
        $this->executionTime = (int) ($endTime - $startTime);
    }

    private function setIsHit(): bool {
        $hitState = false;
        foreach ($this->checkers as $checker)
            $hitState = $hitState || $checker->check();
        return $hitState;
    }

    /**
     * @return float
     */
    public function getX(): float {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float {
        return $this->y;
    }

    /**
     * @return float
     */
    public function getRadius(): float {
        return $this->radius;
    }

    /**
     * @return bool
     */
    public function isHit(): bool {
        return $this->isHit;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getTimestamp(): DateTimeImmutable {
        return $this->timestamp;
    }


    /**
     * @return DateTimeImmutable
     */
    public function getTimestampAsHumanReadableString(): string {
        return date("h:i - d/m/Y", $this->timestamp->getTimestamp());
    }

    /**
     * @return int
     */
    public function getExecutionTime(): int {
        return $this->executionTime;
    }

    public function getHumanReadableExecutionTime(): string {
        return ($this->executionTime / 1e6) . "ms";
    }
}