<?php
require 'credentials.php';
$event = $_POST['event'];
if($event !== 'event_name'){
    $event = unserialize($event);
}
$student = $_POST['student'];
if($student !== 'name'){
    $student = unserialize($student);
}
?>
