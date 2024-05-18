<?php
namespace event\details;

use event\contract\EventContract;
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
        $envPath = realpath(dirname(__FILE__) . '/../../.env');
        $env = parse_ini_file($envPath);

        $getEventDetails = $conn->query("SELECT * FROM `events` WHERE id = " . $id)->fetch_assoc();
        $eventName = $getEventDetails["name"];
        $eventDesc = $getEventDetails["description"];
        $eventLocation = $getEventDetails["location"];
        $eventStartDate = $getEventDetails["date"];
        $timeFrom = $getEventDetails["time_from"];
        $timeTo = $getEventDetails["time_to"];

        $startDatetime = new \DateTime($eventStartDate . " " . $timeFrom);
        $endDatetime = new \DateTime($eventStartDate . " " . $timeTo);

        $formatedStartDate = $startDatetime->format(\DateTime::ATOM);
        $formatedEndDate = $endDatetime->format(\DateTime::ATOM);

        $emailsArray = explode(",", $env["ATTENDEES_EMAILS"]);
        $attendees = [];
        foreach ($emailsArray as $email) {
            $attendees[] = array('email' => $email);
        }

        $accessToken = $_SESSION['access_token'];
        $client = new \Google_Client();
        $client->setAccessToken($accessToken);
        $service = new \Google\Service\Calendar($client);

        // Create a new event
        $event = new \Google\Service\Calendar\Event(
            array(
                'summary' => $eventName,
                'location' => $eventLocation,
                'description' => $eventDesc,
                'start' => array(
                    'dateTime' => $formatedStartDate,
                    'timeZone' => 'Asia/Kathmandu',
                ),
                'end' => array(
                    'dateTime' => $formatedEndDate,
                    'timeZone' => 'Asia/Kathmandu',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=2'
                ),
                'attendees' => $attendees,
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
            $updateSql = "UPDATE events SET google_calendar_event_id = '$event->htmlLink' WHERE id = '$id'";
            if ($conn->query($updateSql) === TRUE) {
                $conn->close();
                return true;
            } else {
                header("Location: ../index.php?page=create&errorMsg=" . urlencode('Mysql Exectution Failed: ' . $conn->error));
                exit();
            }
        } catch (Exception $e) {
            header("Location: ../index.php?page=create&errorMsg=" . urlencode($e->getMessage()));
            exit();
        }
    }

}