<html>
<head>
    <title>Attendance Report</title>
</head>
<body>
<H1>Attendance Report</H1>
<H2>Select which events / students you want on the report</H2>
<form action="attendanceRptAction.php" method="post">
<?php
require 'credentials.php';

echo "<label for='event'>Choose an event:</label>";
echo "<select name='event' id='event'>";
$query = "SELECT id, event_name FROM EA_EVENT";
echo "<option value=null>All Events</option>";
getOptions($mysqli, $query);

echo "<label for='student'>Choose a student:</label>";
echo "<select name='student' id='student'>";
$query = "SELECT id, name FROM EA_STUDENT";
echo "<option value=null>All Students</option>";
getOptions($mysqli, $query);

echo "<label for='startDate'>Begin Date:</label>";
echo "<input type='date' id='startDate' name='startDate'>";
echo "<label for='endDate'>End Date:</label>";
echo "<input type='date' id='endDate' name='endDate'>";

?>
<br>
<input type='submit' name ='Btn' value='Submit'>
</form>
</body>
</html>
