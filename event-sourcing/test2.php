<?php declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

$eventStore = InMemoryEventStore::load();

$counter = Counter::fromEvents($eventStore->allEvents());
var_dump($counter);
