<?php
require 'credentials.php';
function parseInput($in, $replaceNullWith, $text, $shouldUnserialize){
    if($in == null || $in == "all"){
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

$event = parseInput($_POST['event'], 'all', 'All Events', true);
$student = parseInput($_POST['student'], 'all', 'All Students', true);

$startDate = parseInput($_POST['startDate'], 'all', 'None', false);
$endDate = parseInput($_POST['endDate'], 'all', 'None', false);

echo "<p>$event[1]<br>";
echo "$student[1]<br>";
echo "Begin Date: $startDate[1] End Date: $endDate[1]</p>";

$query = "SELECT name, event_name, event_date
FROM `EA_ATTEND`
JOIN EA_STUDENT ON student_id=EA_STUDENT.id
JOIN EA_EVENT ON event_id=EA_EVENT.id
WHERE 1=1";

if ($student[0] !== "all") {
    $query = $query." AND student_id = ".$student[0];
}
if ($event[0] !== "all") {
    $query = $query." AND event_id = ".$event[0];
}
if ($startDate[0] !== "all") {
    $query = $query." AND event_date >= '".$startDate[0]."'";
}
if ($endDate[0] !== "all") {
    $query = $query." AND event_date <= '".$endDate[0]."'";
}

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
