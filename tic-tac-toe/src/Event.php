<?php declare(strict_types=1);

namespace phpce\tictactoe;

interface Event
{
    public function topic(): string;
}
