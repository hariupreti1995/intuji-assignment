<?php
include_once("validation/event.php");
if (!empty($errors)) {
    header("Location: ../index.php?page=create&errors=" . urlencode(serialize($errors))."&data=".urlencode(serialize($formData)));
    exit();
}
if (empty($errors) && $_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted successfully!";
}

?>