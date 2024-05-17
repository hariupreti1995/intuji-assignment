<?php
namespace event\details;
use event\contract\EventContract;
use dbconnection;
class Event
{
    protected $eventContract;
    

    public function __construct(EventContract $eventContract)
    {
        $this->eventContract = $eventContract;
    }

    public function createNewEvent()
    {
        include ("../connection/mysqlconnection.php");
        $getFormData = $this->eventContract;
        $columns = implode(", ", array_keys($getFormData->event));
        $plainData = $getFormData->event;
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($plainData));
        $values = implode("', '", $escaped_values);
        $sql = "INSERT INTO `events`($columns) VALUES ('$values')";
        if ($conn->query($sql) === TRUE) {
            $lastRecordedId = $conn->insert_id;
            //Event set on calendar
        }
    }

}