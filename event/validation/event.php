<?php
$errors = [];
$formData = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    if (empty($name)) {
        $errors["name"] = "Event name is required";
    }
    // Validate description
    $description = trim($_POST["description"]);
    if (empty($description)) {
        $errors["description"] = "A short description for event is required";
    }
    // Validate location
    $location = trim($_POST["location"]);
    // Validate date
    $eventDate = trim($_POST["date"]);
    if (empty($eventDate)) {
        $errors["date"] = "Event date is required";
    } elseif (!strtotime($eventDate)) {
        $errors["date"] = "Invalid date format supplied";
    }

    $time_from = trim($_POST["time_from"]);
    if (empty($time_from)) {
        $errors["time_from"] = "Start time is required";
    } elseif (!strtotime($time_from)) {
        $errors["time_from"] = "Invalid time format supplied";
    }

    $time_to = trim($_POST["time_to"]);
    if (empty($time_to)) {
        $errors["time_to"] = "End time is required";
    } elseif (!strtotime($time_to)) {
        $errors["time_to"] = "Invalid time format supplied";
    }

    $formData = ["name" => $name, "description" => $description, "location" => $location, "date" => $eventDate, "time_from" => $time_from, "time_to" => $time_to];
}