<?php
namespace event\details;

use event\contract\EventContract;
use dbconnection;
use Exception;

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
            //verify that we have any connected service available or not yet.
            $result = $conn->query("SELECT * FROM `integrations` WHERE token IS NOT NULL AND service = 'google-calendar-api' ORDER BY id DESC LIMIT 1");
            if ($result->num_rows === 1) {
                return $this->setEventOnCalendar($conn, $lastRecordedId);
            }
        }
    }

    public function setEventOnCalendar($conn, $id)
    {
        $accessToken = $_SESSION['access_token'];
        $client = new \Google_Client();
        $client->setAccessToken($accessToken);
        $service = new \Google\Service\Calendar($client);

        // Create a new event
        $event = new \Google\Service\Calendar\Event(
            array(
                'summary' => 'Google I/O 2024',
                'location' => '800 Howard St., San Francisco, CA 94103',
                'description' => 'A chance to hear more about Google\'s developer products.',
                'start' => array(
                    'dateTime' => '2024-05-18T09:00:00-07:00',
                    'timeZone' => 'Asia/Kathmandu',
                ),
                'end' => array(
                    'dateTime' => '2024-05-18T09:40:10-07:00',
                    'timeZone' => 'Asia/Kathmandu',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=2'
                ),
                'attendees' => array(
                    array('email' => 'sujatakhatiwoda2002@gmail.com'),
                    array('email' => 'hariupreti1996@gmail.com'),
                    array('email' => 'hariupreti1995@gmail.com'),
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                    ),
                ),
            )
        );

        $calendarId = 'primary';
        try {
            $event = $service->events->insert($calendarId, $event);
            return $event->htmlLink;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

}