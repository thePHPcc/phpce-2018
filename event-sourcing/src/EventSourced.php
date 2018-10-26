<?php declare(strict_types=1);

trait EventSourced
{
    /**
     * @var Event[]
     */
    private $events = [];

    private function reconstituteFrom(array $events): void
    {
        foreach ($events as $event) {
            $this->apply($event);
        }
    }

    private function emit(Event $event): void
    {
        $this->apply($event);
        $this->events[] = $event;
    }

    public function emittedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    private function apply(Event $event)
    {
        $method = 'apply' . get_class($event);
        $this->$method($event);

        /* or explicitly, but then in Counter, not here in the trait
        switch (get_class($event)) {
            case CounterInitializedEvent::class:
                $this->applyCounterInitializedEvent($event);
                break;
            case CounterIncrementedEvent::class:
                $this->applyCounterIncrementedEvent($event);
                break;
        }
        */
    }
}
