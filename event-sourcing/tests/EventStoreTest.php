<?php declare(strict_types=1);

class EventStoreTest extends PHPUnit\Framework\TestCase
{
    public function testSavesEvent()
    {
        $eventStore = new InMemoryEventStore;

        $event = new CounterInitializedEvent(1);

        $eventStore->store($event);

        $events = $eventStore->allEvents();

        $this->assertCount(1, $events);
        $this->assertContainsOnlyInstancesOf(Event::class, $events);
        $this->assertEquals(1, $events[0]->initialValue());
    }
}
