<?php
require 'credentials.php';
function parseInput($in, $toCheckFor, $text, $shouldUnserialize){
    if($in == $toCheckFor){
        $in = [$toCheckFor, $text];
    }
    else{
        if ($shouldUnserialize) {
            $in = unserialize($in);
        }
    }
    return $in;
}

/*$event = $_POST['event'];
if($event === 'event_name'){
    $event = ['event_name', 'All Events'];
}
else{
    $event = unserialize($event);
}*/

$event = parseInput($_POST['event'], 'event_name', 'All Events', true);
$student = parseInput($_POST['student'], 'name', 'All Students', true);

$startDate = parseInput($_POST['startDate'], null, 'None', false);
$endDate = parseInput($_POST['endDate'], null, 'None', false);

echo "<p>$event[1]<br>";
echo "$student[1]<br>";
echo "Begin Date: $startDate[1] End Date: $endDate[1]</p>";

?>
