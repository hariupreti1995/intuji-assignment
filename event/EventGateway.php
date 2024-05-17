<?php
namespace event;
use event\contract\EventContract;

class EventGateway implements EventContract
{
    public $event;
    public $case;


    function __construct($event,$case="create"){
        $this->event = $event;
        $this->case = $case;
    }

    public function setSource($event)
    {
        return [
            'event' => $this->event,
            'case' => $this->case,
        ];
    }
    
}