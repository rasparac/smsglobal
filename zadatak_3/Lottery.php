<?php


class Lottery {

    protected $date;
    const DRAW_START= 20;

    public function __construct(string $date = 'now') {
        $this->date = new DateTimeImmutable($date);
    }

    public function nextDraw() {
        $drawDate = null;

        if ($this->wednesday() > $this->saturday()) {
            if ($this->isSameDay($this->saturday())) {
                $drawDate = $this->handleSameDay($this->saturday(), 'wednesday');
            } else {
                $drawDate = $this->saturday();
            }
        } else {
            if ($this->isSameDay($this->wednesday())) {
                $drawDate = $this->handleSameDay($this->wednesday(), 'saturday');
            } else {
                $drawDate = $this->wednesday();
            }
        }

        return $drawDate->format('d.m.Y h:i a');
    }

    private function handleSameDay(DateTimeImmutable $date, string $day): DateTimeImmutable {
        return $this->isDrawOver() ? $this->{$day}() : $date;
    }

    private function wednesday(): DateTimeImmutable {
        return $this->date->modify('Wednesday 20:00');
    }

    private function saturday(): DateTimeImmutable {
        return $this->date->modify('Saturday 20:00');
    }

    private function isSameDay(DateTimeImmutable $date): bool {
        return $this->day($this->date) === $this->day($date);
    }

    private function day(DateTimeImmutable $date): int {
        return (int) $date->format('w');
    }

    private function isDrawOver(): bool {
        return (int) $this->date->format('H') >= self::DRAW_START;
    }

}

$lottery = new Lottery();
$nextDraw = $lottery->nextDraw();

var_dump($nextDraw);

