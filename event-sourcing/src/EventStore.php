<?php declare(strict_types=1);

interface EventStore
{
    public function store(Event $event): void;
    public function allEvents(): array;
}
