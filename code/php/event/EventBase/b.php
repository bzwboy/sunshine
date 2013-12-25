<?php
function print_line($fd, $events, $arg)
{
    static $max_requests = 0;

    $max_requests++;

    if ($max_requests == 10) {
        // exit loop after 10 writes
    }

    // print the line
    echo  fgets($fd);
}

// create base and event
$base = event_base_new();
$event = event_new();

$fd = STDIN;

// set event flags
event_set($event, $fd, EV_READ | EV_PERSIST, "print_line", array($event, $base));
// set event base
event_base_set($event, $base);

// enable event
event_add($event);

while(1) {
    event_base_loopexit($base, 6000000);
    echo "=========== debug ============\n";
    // start event loop
    event_base_loop($base);
}
