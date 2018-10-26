<?php declare(strict_types=1);

namespace phpce\tictactoe;

interface EventStore
{
    public function store(Event $event): void;
    public function loadAll(): array;
}
