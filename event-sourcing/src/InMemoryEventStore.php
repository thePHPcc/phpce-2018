<?php declare(strict_types=1);

class InMemoryEventStore implements EventStore
{
    private static $filename = 'eventStore';

    private $events = [];

    public static function initialize(): EventStore
    {
        return new InMemoryEventStore;
    }

    public static function load(): EventStore
    {
        return unserialize(file_get_contents(self::$filename));
    }

    public function persist(): void
    {
        file_put_contents(self::$filename, serialize($this));
    }

    public function store(Event $event): void
    {
        $this->events[] = $event;
    }

    public function allEvents(): array
    {
        return $this->events;
    }
}
