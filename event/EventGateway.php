<?php
namespace event;
use event\contracts\EventContract;

class EventGateway implements EventContract
{
    public $event;

    function __construct($event){
        $this->event = $event;
    }

    public function setSource($event)
    {
        return [
            'event' => $this->event,
        ];
    }
    
}