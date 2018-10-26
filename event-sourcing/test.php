<?php declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

$eventStore = new InMemoryEventStore;
$counter = Counter::initialize();
$counter->increment();
$counter->increment();
$counter->increment();

foreach ($counter->emittedEvents() as $event) {
    $eventStore->store($event);
}

$eventStore->persist();

// var_dump($eventStore);

// $counter2 = Counter::fromEvents($eventStore->allEvents());
// var_dump($counter, $counter2);
