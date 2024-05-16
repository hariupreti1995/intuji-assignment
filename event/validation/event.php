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
    $from_date = trim($_POST["from_date"]);
    if (empty($from_date)) {
        $errors["from_date"] = "From date is required";
    } elseif (!strtotime($from_date)) {
        $errors["from_date"] = "Invalid date format supplied";
    }

    $to_date = trim($_POST["to_date"]);
    if (empty($to_date)) {
        $errors["to_date"] = "To date is required";
    } elseif (!strtotime($to_date)) {
        $errors["to_date"] = "Invalid date format supplied";
    }

    $formData = ["name" => $name, "description" => $description, "location" => $location, "from_date" => $from_date, "to_date" => $to_date];
}