<html>
<head>
    <title>Event Attendance</title>
</head>
<body>
<H1>Add Student to Event</H1>
<form action="addToEvent.php" method="post">
<?php
require 'credentials.php';

echo "<label for='event'>Choose an event:</label>";
echo "<select name='event' id='event'>";
$query = "SELECT id, event_name FROM EA_EVENT";
getOptions($mysqli, $query);

echo "<label for='student'>Choose a student:</label>";
echo "<select name='student' id='student'>";
$query = "SELECT id, name FROM EA_STUDENT";
getOptions($mysqli, $query);

echo "<input type='submit' name ='Btn' value='Send'>";
echo "</form>";

if(isset($_POST["Btn"])) {
    $event = unserialize($_POST['event']);
    $student = unserialize($_POST['student']);

    $query = "INSERT INTO EA_ATTEND(event_id, student_id) VALUES('".$event[0]."', '".$student[0]."')";

    if($result = $mysqli->query($query)){
        echo "<p>Added ".$student[1]." to event ".$event[1].".</p>";
    }
    else{
        echo "Error in querying: $query. ".mysqli->error;
    }
}
$mysqli->close();
?>
</body>
</html>
