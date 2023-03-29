<?php
require 'credentials.php';
function parseInput($in, $replaceNullWith, $text, $shouldUnserialize){
    if($in == null){
        $in = [$replaceNullWith, $text];
    }
    else{
        if ($shouldUnserialize) {
            $in = unserialize($in);
        }
        else{
            $in = [$in, $in];
        }
    }
    return $in;
}

$event = parseInput($_POST['event'], 'event_id', 'All Events', true);
$student = parseInput($_POST['student'], 'student_id', 'All Students', true);

$startDate = parseInput($_POST['startDate'], 'event_date', 'None', false);
$endDate = parseInput($_POST['endDate'], 'event_date', 'None', false);

echo "<p>$event[1]<br>";
echo "$student[1]<br>";
echo "Begin Date: $startDate[1] End Date: $endDate[1]</p>";

$query = "
SELECT name, event_name, event_date
FROM `EA_ATTEND`
JOIN EA_STUDENT ON student_id=EA_STUDENT.id
JOIN EA_EVENT ON event_id=EA_EVENT.id
WHERE student_id = $student[0] AND event_id = $event[0]
AND event_date BETWEEN $startDate[0] AND $endDate[0]
";

if($result = $mysqli->query($query)){
	if($result->num_rows > 0){
		echo "<table cellpadding=10 border=1>";
        echo "<tr>";
            echo "<th>Student</th>";
            echo "<th>Event</th>";
            echo "<th>Event Date</th>";
        echo "</tr>";
		while($row = $result->fetch_array()){
			echo "<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
            echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "No rows returned.";
	}

	$result->close();
}
else{
	echo "Error in querying: $query. ".mysqli->error;
}
$mysqli->close();
?>
